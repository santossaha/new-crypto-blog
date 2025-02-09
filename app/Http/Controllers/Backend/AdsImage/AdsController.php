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


    public function addImage(){
        return "sdfsdf";
       // return view('Backend.AdsImage.Add');
    }

    public function save(Request $request){
        dd($request->all());


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
