<?php

namespace App\Http\Controllers\Backend\Airdrops;

use App\Http\Controllers\Controller;
use App\Helpers\ICOOptionHelper;
use App\Models\AirDrop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AirDropController extends Controller
{
    const IMAGE_DIRECTORY = 'airdrop';
    const IMAGE_PREFIX = 'ad';

    /**
     * Display all Airdrops
     */
    public function all()
    {
        return view('Backend.airdrops.All');
    }

    /**
     * Show create Airdrop form
     */
    public function add()
    {
        $data = [
            'categories' => AirDrop::getProjectCategories(),
            'networks' => AirDrop::getBlockchainNetworks(),
        ];
        return view('Backend.airdrops.Add', $data);
    }

    /**
     * Store new Airdrop
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'platform' => 'nullable|string|max:255',
            'project_category' => 'nullable|string|max:255',
            'blockchain_network' => 'nullable|string|max:255',
            'total_supply' => 'nullable|numeric|min:0',
            'total_airdrop_qty' => 'nullable|numeric|min:0',
            'airdrop_value' => 'nullable|numeric|min:0',
            'winner_count' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date_format:d-m-Y',
            'end_date' => 'nullable|date_format:d-m-Y|after_or_equal:start_date',
            'winner_announcement_date' => 'nullable|date_format:d-m-Y',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'participate_link' => 'nullable|url|max:500',
            'website_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'telegram_url' => 'nullable|url|max:500',
            'discord_url' => 'nullable|url|max:500',
            'whitepaper_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'how_to_participate' => 'nullable|string',
            'status' => 'nullable|in:Active,Inactive',
            'airdrop_status' => 'nullable|in:Upcoming,Ongoing,Ended',
        ]);

        $save = new AirDrop();
        $save->name = $request->get('name');
        $save->slug = Str::slug($request->get('name'));
        $save->platform = $request->get('platform');
        $save->participate_link = $request->get('participate_link');

        $save->total_supply = $request->get('total_supply');
        $save->total_airdrop_qty = $request->get('total_airdrop_qty');
        $save->airdrop_value = $request->get('airdrop_value');

        // Calculate supply percentage if possible
        if ($save->total_supply > 0 && $save->total_airdrop_qty > 0) {
            $save->supply_percentage = ($save->total_airdrop_qty / $save->total_supply) * 100;
        } else {
            $save->supply_percentage = $request->get('supply_percentage');
        }

        $save->winner_count = $request->get('winner_count');

        // Handle dates
        $save->start_date = $this->convertDateFormat($request->get('start_date'));
        $save->end_date = $this->convertDateFormat($request->get('end_date'));
        $save->winner_announcement_date = $this->convertDateFormat($request->get('winner_announcement_date'));

        // Handle project_category - auto-add if new
        $projectCategory = $request->get('project_category');
        if ($projectCategory && !ICOOptionHelper::projectCategoryExists($projectCategory)) {
            ICOOptionHelper::addProjectCategory($projectCategory);
        }
        $save->project_category = $projectCategory;

        // Handle blockchain_network - auto-add if new
        $blockchainNetwork = $request->get('blockchain_network');
        if ($blockchainNetwork && !ICOOptionHelper::blockchainNetworkExists($blockchainNetwork)) {
            ICOOptionHelper::addBlockchainNetwork($blockchainNetwork);
        }
        $save->blockchain_network = $blockchainNetwork;

        $save->description = $request->get('description');
        $save->how_to_participate = $request->get('how_to_participate');
        $save->website_url = $request->get('website_url');
        $save->twitter_url = $request->get('twitter_url');
        $save->telegram_url = $request->get('telegram_url');
        $save->discord_url = $request->get('discord_url');
        $save->whitepaper_url = $request->get('whitepaper_url');

        $save->meta_title = $request->get('meta_title');
        $save->meta_description = $request->get('meta_description');
        $save->meta_keyword = $request->get('meta_keyword');
        $save->canonical = $request->get('canonical');

        $save->status = $request->get('status') ?? 'Active';
        $save->airdrop_status = $request->get('airdrop_status') ?? 'Upcoming';

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $save->image = uploadImage($file, self::IMAGE_DIRECTORY, null, self::IMAGE_PREFIX);
        }

        $save->save();

        Session::flash('success', "Airdrop has been created successfully");
        return redirect()->route('allAirdrops');
    }

    /**
     * Datatable for Airdrop listing
     */
    public function datatable()
    {
        $query = AirDrop::orderBy('id', 'desc')
            ->select('id', 'image', 'name', 'platform', 'start_date', 'end_date', 'airdrop_status', 'status');

        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if ($data->image != '') {
                    return '<img src="' . getFullPath(self::IMAGE_DIRECTORY, $data->image) . '" width="60px" style="border-radius:5px;" />';
                } else {
                    return '<span class="label label-default">No Image</span>';
                }
            })
            ->addColumn('start_date', function ($data) {
                return $data->start_date ? date('d-m-Y', strtotime($data->start_date)) : 'TBA';
            })
            ->addColumn('end_date', function ($data) {
                return $data->end_date ? date('d-m-Y', strtotime($data->end_date)) : 'TBA';
            })
            ->editColumn('airdrop_status', function ($data) {
                $status = $data->airdrop_status ?? 'Upcoming';
                $badgeClass = match($status) {
                    'Ongoing' => 'label-success',
                    'Ended' => 'label-warning',
                    default => 'label-info',
                };
                return '<span class="label ' . $badgeClass . '">' . $status . '</span>';
            })
            ->editColumn('status', function ($data) {
                $status = $data->status ?? 'Active';
                if ($status == 'Active' || $status == 'Inactive') {
                    $checked = ($status == 'Active') ? 'checked' : '';
                    return '<div style="display: block">
                        <label class="switch">
                            <input onchange="change_status_action(' . $data->id . ')" id="checkbox_' . $data->id . '" data-id="' . $data->id . '" type="checkbox" ' . $checked . ' />
                            <div class="slider round"></div>
                        </label>
                    </div>';
                }
                return $status;
            })
            ->addColumn('action', function ($data) {
                $url_update = route('editAirdrop', ['id' => $data->id]);
                $url_delete = route('deleteAirdrop', ['id' => $data->id]);

                $edit = '<a class="label label-primary" href="' . $url_update . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp;<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Airdrop: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';

                return $edit;
            })
            ->rawColumns(['id', 'action', 'image', 'airdrop_status', 'status'])
            ->toJson();
    }

    /**
     * Show edit Airdrop form
     */
    public function edit($id = null)
    {
        $records = AirDrop::findOrFail($id);

        // Format dates
        if ($records->start_date) $records->start_date = date('d-m-Y', strtotime($records->start_date));
        if ($records->end_date) $records->end_date = date('d-m-Y', strtotime($records->end_date));
        if ($records->winner_announcement_date) $records->winner_announcement_date = date('d-m-Y', strtotime($records->winner_announcement_date));

        $data = [
            'records' => $records,
            'categories' => AirDrop::getProjectCategories(),
            'networks' => AirDrop::getBlockchainNetworks(),
        ];
        return view('Backend.airdrops.Edit', $data);
    }

    /**
     * Update Airdrop
     */
    public function update(Request $request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'platform' => 'nullable|string|max:255',
            'project_category' => 'nullable|string|max:255',
            'blockchain_network' => 'nullable|string|max:255',
            'total_supply' => 'nullable|numeric|min:0',
            'total_airdrop_qty' => 'nullable|numeric|min:0',
            'airdrop_value' => 'nullable|numeric|min:0',
            'winner_count' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date_format:d-m-Y',
            'end_date' => 'nullable|date_format:d-m-Y|after_or_equal:start_date',
            'winner_announcement_date' => 'nullable|date_format:d-m-Y',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'participate_link' => 'nullable|url|max:500',
            'website_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'telegram_url' => 'nullable|url|max:500',
            'discord_url' => 'nullable|url|max:500',
            'whitepaper_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'how_to_participate' => 'nullable|string',
            'status' => 'nullable|in:Active,Inactive',
            'airdrop_status' => 'nullable|in:Upcoming,Ongoing,Ended',
        ]);

        $update = AirDrop::findOrFail($id);
        $update->name = $request->get('name');
        $update->slug = Str::slug($request->get('name'));
        $update->platform = $request->get('platform');
        $update->participate_link = $request->get('participate_link');

        $update->total_supply = $request->get('total_supply');
        $update->total_airdrop_qty = $request->get('total_airdrop_qty');
        $update->airdrop_value = $request->get('airdrop_value');

        // Calculate supply percentage if not provided but supplies are
        if ($update->total_supply > 0 && $update->total_airdrop_qty > 0) {
            $update->supply_percentage = ($update->total_airdrop_qty / $update->total_supply) * 100;
        } else {
            $update->supply_percentage = $request->get('supply_percentage');
        }

        $update->winner_count = $request->get('winner_count');

        // Handle dates
        $update->start_date = $this->convertDateFormat($request->get('start_date'));
        $update->end_date = $this->convertDateFormat($request->get('end_date'));
        $update->winner_announcement_date = $this->convertDateFormat($request->get('winner_announcement_date'));

        // Handle project_category
        $projectCategory = $request->get('project_category');
        if ($projectCategory && !ICOOptionHelper::projectCategoryExists($projectCategory)) {
            ICOOptionHelper::addProjectCategory($projectCategory);
        }
        $update->project_category = $projectCategory;

        // Handle blockchain_network
        $blockchainNetwork = $request->get('blockchain_network');
        if ($blockchainNetwork && !ICOOptionHelper::blockchainNetworkExists($blockchainNetwork)) {
            ICOOptionHelper::addBlockchainNetwork($blockchainNetwork);
        }
        $update->blockchain_network = $blockchainNetwork;

        $update->description = $request->get('description');
        $update->how_to_participate = $request->get('how_to_participate');
        $update->website_url = $request->get('website_url');
        $update->twitter_url = $request->get('twitter_url');
        $update->telegram_url = $request->get('telegram_url');
        $update->discord_url = $request->get('discord_url');
        $update->whitepaper_url = $request->get('whitepaper_url');

        $update->meta_title = $request->get('meta_title');
        $update->meta_description = $request->get('meta_description');
        $update->meta_keyword = $request->get('meta_keyword');
        $update->canonical = $request->get('canonical');

        $update->status = $request->get('status') ?? 'Active';
        $update->airdrop_status = $request->get('airdrop_status') ?? 'Upcoming';

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $update->image = uploadImage($file, self::IMAGE_DIRECTORY, $update->image, self::IMAGE_PREFIX);
        }

        $update->save();

        Session::flash('success', "Airdrop has been updated successfully");
        return redirect()->back();
    }

    /**
     * Delete Airdrop
     */
    public function delete($id = null)
    {
        $remove = AirDrop::findOrFail($id);
        if ($remove->image) {
            deleteImage(getImageUrl(self::IMAGE_DIRECTORY, $remove->image));
        }
        $remove->delete();
        Session::flash('success', "Airdrop has been deleted successfully");
        return redirect()->back();
    }

    /**
     * Toggle status
     */
    public function statusAirdrop($id)
    {
        $item = AirDrop::find($id);

        if (empty($item)) {
            return response()->json(['success' => false, 'message' => 'Record not found!']);
        }

        $item->status = ($item->status == 'Active' ? 'Inactive' : 'Active');
        $item->save();

        return response()->json(['success' => true, 'message' => 'Status successfully changed.']);
    }

    /**
     * Convert DD-MM-YYYY to YYYY-MM-DD
     */
    private function convertDateFormat($date)
    {
        if (empty($date)) return null;
        try {
            return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return date('Y-m-d', strtotime($date));
        }
    }
}
