<?php

namespace App\Http\Controllers\Backend\AdsImage;

use Illuminate\Http\Request;
use App\Models\AdsImageModel;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use function App\Http\Controllers\Backend\Banner\public_path;

class AdsController extends Controller
{

    public function addImage(){
        $record = AdsImageModel::first();
        if($record){
            return view('Backend.ads_image.add',['record'=>$record]);
        }
    }

    public function saveAddsImage(Request $request)
    {

        $save = AdsImageModel::firstOrNew(['id' => $request->id]);

        $request->validate([
            'requird_image' => $save->exists ? 'nullable|image' : 'required|image',
            'ads_image' => 'nullable|image',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        $save = AdsImageModel::firstOrNew(['id' => $request->id]);

        if ($request->hasFile('requird_image')) {
            $file = $request->file('requird_image');
            $requiredImageName = time() . '_required_image.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('adds/' . $requiredImageName, file_get_contents($file));
            $save->requird_image = $requiredImageName;
        }
        if ($request->hasFile('ads_image')) {
            $file = $request->file('ads_image');
            $adsImageName = time() . '_ads_image.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('adds/' . $adsImageName, file_get_contents($file));
            $save->ads_image = $adsImageName;
        }
        $save->start_date = $request->start_date;
        $save->end_date = $request->end_date;
        dd($save);
        $save->save();
        Session::flash('success', "Ads has been created successfully");
        return redirect()->back();
    }

}
