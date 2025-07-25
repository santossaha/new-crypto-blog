<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Controller;
// use App\Model\Banner;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{

    public function index(){




        return view('Backend.Banner.All', [
            'statuses' => [
                'active' => Banner::ACTIVE,
                'Inactive' => Banner::Inactive,
            ],
        ]);

    }
    public function datatable(){
        $query = Banner::select('id','image','status');
        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if($data->image!=''){
                    return '<img src="' .  getImageUrl('banner',$data->image) . '" width="80px"/>';
                }else{
                    return 'N/A';
                }

            })
            ->addColumn('action', function ($data)  {
                $url_update = route('editBanner', ['id' => $data->id]);
                $url_delete = route('deleteBanner', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Banner" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Banner: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';

                return $edit;
            })
            ->rawColumns(['image','status','action'])
            ->toJson();
    }
    public function add(){

        return view('Backend.Banner.Add');
    }

    public function save(Request $request){


        $this->validate($request, [
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            foreach($request->image as $image){
                $save = new Banner();
                $save->image = uploadImage($image, 'banner', null, 'slider');
                $save->status = 'Active';
                $save->url = $request->input('url');
                $save->save();
            }
        }

        Session::flash('success', "Banner has been created successfully");
        return redirect()->back();
    }

    public function edit($id)
    {
        $records = Banner::findOrFail($id);

        return view('Backend.Banner.Edit',['records'=>$records]);

    }

    public function update(Request $request,$id){

        $this->validate($request, [
            'image' => 'required|nullable|sometimes',
        ]);

        $update = Banner::findOrFail($id);

        if(!empty($request->file('image'))){
            // Use the helper function to handle image upload
            $update->image = uploadImage($request->file('image'), 'banner', getImageUrl('banner', $update->image), 'slider');
        }

        $update->url = $request->input('url');
        $update->save();

        Session::flash('success', "Banner has been updated");
        return redirect()->back();
    }

    public function delete($id=null){
        $Remove = Banner::findOrFail($id);

        // Delete the image if it exists
        if ($Remove->image) {
            deleteImage(getImageUrl('banner', $Remove->image));
        }

        $Remove->delete();
        Session::flash('success', "Banner has been deleted");
        return redirect()->back();
    }
    public function status_banner(Request $request)
    {


        $item_id = $request->get('item_id');
        $item = Banner::find($item_id);

        if(empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found!',
            ]);
        } else {
            if($item->status == 'Active' || $item->status == 'Inactive'){
                $item->status = ($item->status == 'Active' ? 'Inactive' : 'Active');
                $item->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Item status successfully changed.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found!',
                ]);
            }
        }
    }

}
