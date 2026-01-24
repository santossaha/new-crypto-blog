<?php

namespace App\Http\Controllers\Backend\ICO;

use App\Http\Controllers\Controller;
use App\Models\ICO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ICOController extends Controller
{
    const IMAGE_DIRECTORY = 'ico';
    const IMAGE_PREFIX = 'ico';

    /**
     * Display all ICOs
     */
    public function all()
    {
        return view('Backend.ICO.All');
    }

    /**
     * Show create ICO form
     */
    public function add()
    {
        $data = [
            'stages' => ICO::getStages(),
            'categories' => ICO::getProjectCategories(),
            'networks' => ICO::getBlockchainNetworks(),
            'icoStatuses' => ICO::getIcoStatuses(),
        ];
        return view('Backend.ICO.Add', $data);
    }

    /**
     * Store new ICO
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:icos,name',
            'launchpad' => 'nullable|string|max:255',
            'stage' => 'nullable|string|max:100',
            'total_supply_qty' => 'nullable|numeric|min:0',
            'tokens_for_sale' => 'nullable|numeric|min:0',
            'supply_percentage' => 'nullable|numeric|min:0|max:100',
            'ico_price' => 'nullable|numeric|min:0',
            'ico_price_currency' => 'nullable|string|max:20',
            'one_usdt_value' => 'nullable|string|max:100',
            'fundraising_goal' => 'nullable|numeric|min:0',
            'project_category' => 'nullable|string|max:100',
            'contract_address' => 'nullable|string|max:255',
            'blockchain_network' => 'nullable|string|max:100',
            'buy_link' => 'nullable|url|max:500',
            'soft_cap' => 'nullable|string|max:100',
            'hard_cap' => 'nullable|string|max:100',
            'personal_cap' => 'nullable|string|max:100',
            'start_date' => 'nullable|date_format:d-m-Y',
            'end_date' => 'nullable|date_format:d-m-Y|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'website_url' => 'nullable|url|max:500',
            'whitepaper_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'telegram_url' => 'nullable|url|max:500',
            'discord_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'canonical' => 'nullable|string|max:500',
            'ico_status' => 'nullable|in:Upcoming,Ongoing,Ended',
        ]);

        $save = new ICO();
        $save->name = $request->get('name');
        $save->slug = Str::slug($request->get('name'));
        $save->launchpad = $request->get('launchpad');
        $save->stage = $request->get('stage');
        $save->total_supply_qty = $request->get('total_supply_qty');
        $save->tokens_for_sale = $request->get('tokens_for_sale');
        $save->supply_percentage = $request->get('supply_percentage');
        $save->ico_price = $request->get('ico_price');
        $save->ico_price_currency = $request->get('ico_price_currency') ?? 'USDT';
        $save->one_usdt_value = $request->get('one_usdt_value');
        $save->fundraising_goal = $request->get('fundraising_goal');
        $save->project_category = $request->get('project_category');
        $save->contract_address = $request->get('contract_address');
        $save->blockchain_network = $request->get('blockchain_network');
        $save->buy_link = $request->get('buy_link');
        $save->soft_cap = $request->get('soft_cap');
        $save->hard_cap = $request->get('hard_cap');
        $save->personal_cap = $request->get('personal_cap');

        // Handle dates
        if ($request->get('start_date')) {
            $save->start_date = $this->convertDateFormat($request->get('start_date'));
        }
        if ($request->get('end_date')) {
            $save->end_date = $this->convertDateFormat($request->get('end_date'));
        }

        $save->description = $request->get('description');
        $save->short_description = $request->get('short_description');
        $save->website_url = $request->get('website_url');
        $save->whitepaper_url = $request->get('whitepaper_url');
        $save->twitter_url = $request->get('twitter_url');
        $save->telegram_url = $request->get('telegram_url');
        $save->discord_url = $request->get('discord_url');
        $save->meta_title = $request->get('meta_title');
        $save->meta_description = $request->get('meta_description');
        $save->meta_keyword = $request->get('meta_keyword');
        $save->canonical = $request->get('canonical');
        $save->ico_status = $request->get('ico_status') ?? 'Upcoming';
        $save->status = 'Active';

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $save->image = uploadImage($file, self::IMAGE_DIRECTORY, null, self::IMAGE_PREFIX);
        }

        $save->save();

        Session::flash('success', "ICO has been created successfully");
        return redirect()->route('allICO');
    }

    /**
     * Datatable for ICO listing
     */
    public function datatable()
    {
        $query = ICO::orderBy('id', 'desc')
            ->select('id', 'image', 'name', 'stage', 'start_date', 'end_date', 'ico_status', 'status');

        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if ($data->image != '') {
                    return '<img src="' . getFullPath(self::IMAGE_DIRECTORY, $data->image) . '" width="60px" style="border-radius:5px;" />';
                } else {
                    return '<span class="label label-default">No Image</span>';
                }
            })
            ->addColumn('start_date', function ($data) {
                if ($data->start_date) {
                    return date('d-m-Y', strtotime($data->start_date));
                }
                return 'TBA';
            })
            ->addColumn('end_date', function ($data) {
                if ($data->end_date) {
                    return date('d-m-Y', strtotime($data->end_date));
                }
                return 'TBA';
            })
            ->addColumn('ico_status', function ($data) {
                $status = $data->ico_status ?? 'Upcoming';
                $badgeClass = 'label-default';

                switch ($status) {
                    case 'Ongoing':
                        $badgeClass = 'label-success';
                        break;
                    case 'Upcoming':
                        $badgeClass = 'label-info';
                        break;
                    case 'Ended':
                        $badgeClass = 'label-warning';
                        break;
                }

                return '<span class="label ' . $badgeClass . '">' . $status . '</span>';
            })
            ->addColumn('status', function ($data) {
                $status = $data->status ?? 'Active';
                if ($status == 'Active' || $status == 'Inactive') {
                    $checked = ($status == 'Active') ? 'checked' : '';
                    return '<div style="display: block">
                        <label class="switch">
                            <input onchange="change_status_action(' . $data->id . ')" id="checkbox_' . $data->id . '" data-id="' . $data->id . '" type="checkbox" ' . $checked . ' />
                            <div class="slider round"></div>
                        </label>
                    </div>';
                } else {
                    return '<div style="display: block"><span>' . $status . '</span></div>';
                }
            })
            ->addColumn('action', function ($data) {
                $url_update = route('editICO', ['id' => $data->id]);
                $url_delete = route('deleteICO', ['id' => $data->id]);
                $edit = '<a class="label label-primary" href="' . $url_update . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp;<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete ICO: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                return $edit;
            })
            ->rawColumns(['id', 'action', 'image', 'ico_status', 'status'])
            ->toJson();
    }

    /**
     * Show edit ICO form
     */
    public function edit($id = null)
    {
        $records = ICO::findOrFail($id);

        // Format dates for display
        if ($records->start_date) {
            $records->start_date = date('d-m-Y', strtotime($records->start_date));
        }
        if ($records->end_date) {
            $records->end_date = date('d-m-Y', strtotime($records->end_date));
        }

        $data = [
            'records' => $records,
            'stages' => ICO::getStages(),
            'categories' => ICO::getProjectCategories(),
            'networks' => ICO::getBlockchainNetworks(),
            'icoStatuses' => ICO::getIcoStatuses(),
        ];

        return view('Backend.ICO.Edit', $data);
    }

    /**
     * Update ICO
     */
    public function update(Request $request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required|unique:icos,name,' . $id,
            'launchpad' => 'nullable|string|max:255',
            'stage' => 'nullable|string|max:100',
            'total_supply_qty' => 'nullable|numeric|min:0',
            'tokens_for_sale' => 'nullable|numeric|min:0',
            'supply_percentage' => 'nullable|numeric|min:0|max:100',
            'ico_price' => 'nullable|numeric|min:0',
            'ico_price_currency' => 'nullable|string|max:20',
            'one_usdt_value' => 'nullable|string|max:100',
            'fundraising_goal' => 'nullable|numeric|min:0',
            'project_category' => 'nullable|string|max:100',
            'contract_address' => 'nullable|string|max:255',
            'blockchain_network' => 'nullable|string|max:100',
            'buy_link' => 'nullable|url|max:500',
            'soft_cap' => 'nullable|string|max:100',
            'hard_cap' => 'nullable|string|max:100',
            'personal_cap' => 'nullable|string|max:100',
            'start_date' => 'nullable|date_format:d-m-Y',
            'end_date' => 'nullable|date_format:d-m-Y|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'website_url' => 'nullable|url|max:500',
            'whitepaper_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'telegram_url' => 'nullable|url|max:500',
            'discord_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'canonical' => 'nullable|string|max:500',
            'ico_status' => 'nullable|in:Upcoming,Ongoing,Ended',
        ]);

        $update = ICO::findOrFail($id);
        $update->name = $request->get('name');
        $update->slug = Str::slug($request->get('name'));
        $update->launchpad = $request->get('launchpad');
        $update->stage = $request->get('stage');
        $update->total_supply_qty = $request->get('total_supply_qty');
        $update->tokens_for_sale = $request->get('tokens_for_sale');
        $update->supply_percentage = $request->get('supply_percentage');
        $update->ico_price = $request->get('ico_price');
        $update->ico_price_currency = $request->get('ico_price_currency') ?? 'USDT';
        $update->one_usdt_value = $request->get('one_usdt_value');
        $update->fundraising_goal = $request->get('fundraising_goal');
        $update->project_category = $request->get('project_category');
        $update->contract_address = $request->get('contract_address');
        $update->blockchain_network = $request->get('blockchain_network');
        $update->buy_link = $request->get('buy_link');
        $update->soft_cap = $request->get('soft_cap');
        $update->hard_cap = $request->get('hard_cap');
        $update->personal_cap = $request->get('personal_cap');

        // Handle dates
        if ($request->get('start_date')) {
            $update->start_date = $this->convertDateFormat($request->get('start_date'));
        } else {
            $update->start_date = null;
        }
        if ($request->get('end_date')) {
            $update->end_date = $this->convertDateFormat($request->get('end_date'));
        } else {
            $update->end_date = null;
        }

        $update->description = $request->get('description');
        $update->short_description = $request->get('short_description');
        $update->website_url = $request->get('website_url');
        $update->whitepaper_url = $request->get('whitepaper_url');
        $update->twitter_url = $request->get('twitter_url');
        $update->telegram_url = $request->get('telegram_url');
        $update->discord_url = $request->get('discord_url');
        $update->meta_title = $request->get('meta_title');
        $update->meta_description = $request->get('meta_description');
        $update->meta_keyword = $request->get('meta_keyword');
        $update->canonical = $request->get('canonical');
        $update->ico_status = $request->get('ico_status') ?? 'Upcoming';

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $update->image = uploadImage($file, self::IMAGE_DIRECTORY, $update->image, self::IMAGE_PREFIX);
        }

        $update->save();

        Session::flash('success', "ICO has been updated successfully");
        return redirect()->back();
    }

    /**
     * Delete ICO
     */
    public function delete($id = null)
    {
        $remove = ICO::findOrFail($id);

        // Delete image if exists
        if ($remove->image) {
            deleteImage(getImageUrl(self::IMAGE_DIRECTORY, $remove->image));
        }

        $remove->delete();

        Session::flash('success', "ICO has been deleted successfully");
        return redirect()->back();
    }

    /**
     * Toggle ICO status (Active/Inactive)
     */
    public function statusICO($id)
    {
        $item = ICO::find($id);

        if (empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'ICO not found!',
            ]);
        } else {
            if ($item->status == 'Active' || $item->status == 'Inactive') {
                $item->status = ($item->status == 'Active' ? 'Inactive' : 'Active');
                $item->save();

                return response()->json([
                    'success' => true,
                    'message' => 'ICO status successfully changed.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status!',
                ]);
            }
        }
    }

    /**
     * Convert date from DD-MM-YYYY format to YYYY-MM-DD format
     *
     * @param string $date
     * @return string
     */
    private function convertDateFormat($date)
    {
        if (empty($date)) {
            return null;
        }

        // Check if date is in DD-MM-YYYY format
        if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $date, $matches)) {
            // Convert DD-MM-YYYY to YYYY-MM-DD
            return $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }

        // Try to parse with Carbon (handles various formats)
        try {
            return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Fallback to strtotime if Carbon fails
            return date('Y-m-d', strtotime($date));
        }
    }
}

