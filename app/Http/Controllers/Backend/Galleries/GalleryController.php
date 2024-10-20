<?php

namespace App\Http\Controllers\Backend\Galleries;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\GalleriesModel;
use App\Repo\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    use ImageUpload;
    public function index(){
        return view('Backend.Gallery.All', [
            'statuses' => [
                'active' => GalleriesModel::ACTIVE,
                'Inactive' => GalleriesModel::Inactive,
            ],
        ]);

    }
    public function datatable(){
        $query = GalleriesModel::select('id','image','status');
        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if($data->image!=''){
                    return '<img src="'.url($data->image).'" width="80px"/>';
                }else{
                    return 'N/A';
                }

            })
            ->addColumn('action', function ($data)  {
                $url_update = route('editGallery', ['id' => $data->id]);
                $url_delete = route('deleteGallery', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Gallery" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Gallery: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';

                return $edit;
            })
            ->rawColumns(['image','status','action'])
            ->toJson();
    }
    public function add(){
        return view('Backend.Gallery.Add');
    }

    public function save(Request $request){
        $this->validate($request, [
            'image' => 'required',

        ]);

        $save = new GalleriesModel();
        if ($request->hasFile('image')) {
            $file = $this->imageUpload($request->image,'banner');
            $save->image=$file;

        }
        $save->save();

        Session::flash('success', "Banner has been created successfully");
        return redirect()->back();
    }

    public function edit($id)
    {
        $records = GalleriesModel::findOrFail($id);
        return view('Backend.Gallery.Edit',['records'=>$records]);

    }

    public function update(Request $request,$id){

        $this->validate($request, [
            'image' => 'required|nullable|sometimes',


        ]);

        $update =  GalleriesModel::findOrFail($id);
        if(!empty($request->file('image'))){
            $filepath=$this->imageUpload($request->image,'banner');
            $path=public_path().$update->image;
            if(file_exists($path)){
                unlink($path);
            }
            $pro_photo=$filepath;

        }else{
            $pro_photo=$update->image;

        }


        $update->image = $pro_photo;
        $update->save();

        Session::flash('success', "Banner has been updated");
        return redirect()->back();
    }

    public function delete($id=null){
        $Remove = GalleriesModel::findOrFail($id);
        $path=public_path().$Remove->image;
        if(file_exists($path)){
            unlink($path);
        }
        $Remove->delete();
        Session::flash('success', "Banner has been deleted");
        return redirect()->back();
    }
    public function status_banner(Request $request)
    {


        $item_id = $request->get('item_id');
        $item = GalleriesModel::find($item_id);

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
