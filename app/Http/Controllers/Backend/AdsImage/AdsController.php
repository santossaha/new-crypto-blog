<?php

namespace App\Http\Controllers\Backend\AdsImage;

use App\Http\Controllers\Controller;
use App\Models\AdsImageModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use function App\Http\Controllers\Backend\Banner\public_path;
class AdsController extends Controller
{
   
 
    public function index(){
        return view('Backend.AdsImage.All');

    }
    public function allAdsDatabase(){
        $query = AdsImageModel::select('id','image');
        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if($data->image!=''){
                    return '<img src="'.url($data->image).'" width="80px"/>';
                }else{
                    return 'N/A';
                }

            })
            ->addColumn('action', function ($data)  {
                $url_update = route('editAddsImage', ['id' => $data->id]);
                $url_delete = route('deleteBanner', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Banner" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Banner: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';

                return $edit;
            })
            ->rawColumns(['image','status','action'])
            ->toJson();
    }
    public function addImage(){


        return view('Backend.AdsImage.Add');
    }

    public function save(Request $request){

      
        $this->validate($request, [
            'image' => 'required',
            'expire_date'=>'required'

        ]);

        

        $save = new AdsImageModel();
        if ($request->hasFile('image')) {

            $file = $request->file('image');
   
            $Imagename  = time().'ads_image'.'.'. $file->getClientOriginalExtension();
        
            $file->storeAs('adds', $Imagename, 'public');
            $save->image= $Imagename ;

        }

        $save->expire_date= $request->get('expire_date');
        $save->save();

        Session::flash('success', "Ads has been created successfully");
        return redirect()->back();
    }

    public function edit($id)
    {
        $records = AdsImageModel::findOrFail($id);
        return view('Backend.AdsImage.Edit',['records'=>$records]);

    }

    public function update(Request $request,$id){

        $this->validate($request, [
            'image' => 'required|nullable|sometimes',
        ]);

        $update =  AdsImageModel::findOrFail($id);
        if(!empty($request->file('image'))){
          
            // $path=public_path().$update->image;
          
            $image = $request->file('image');
            // if(file_exists($path)){
            //     unlink($path);
            // }

            $Imagename  = time().'ads_image'.'.'.$image->getClientOriginalExtension();
            $image->storeAs('adds', $Imagename, 'public');
         
            $path= $update->image;


            if(file_exists($path)){
                unlink($path);
            }
            $pro_photo=$Imagename ;

        }else{
            $pro_photo=$update->image;

        }


        $update->image = $pro_photo;
        $update->save();

        Session::flash('success', "Adds has been updated");
        return redirect()->back();
    }



}
