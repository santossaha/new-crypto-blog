<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GeneralSettingsController extends Controller
{
    public function index(){
        $GeneralSetting = GeneralSetting::first();
        return view('Backend.Settings.GeneralSetting.All',['ID'=>$GeneralSetting->id,'data'=>$GeneralSetting]);
    }

    public function saveGeneralSetting(Request $request, $id){
        $this->validate($request, [
            //'site_logo' => 'required',
            'showLogo_inSign' => 'required',
            'showImage_Background' => 'required',
            //'signIn_backgroundImage' => 'required',
            'app_title' => 'required',
            'language' => 'required',
            'timezone' => 'required',
            'dateFormat' => 'required',
            'timeFormat' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'currency_position' => 'required',
            'row_per_page' => 'required',
        ]);

        $showLogo_inSign = $request->get('showLogo_inSign');
        $showImage_Background = $request->get('showImage_Background');
        $app_title = $request->get('app_title');
        $language = $request->get('language');
        $timezone = $request->get('timezone');
        $dateFormat = $request->get('dateFormat');
        $timeFormat = $request->get('timeFormat');
        $currency = $request->get('currency');
        $currency_symbol = $request->get('currency_symbol');
        $currency_position = $request->get('currency_position');
        $row_per_page = $request->get('row_per_page');

        $GeneralSetting= GeneralSetting::findOrFail($id);
        if ($request->hasFile('site_logo')) {
            $file            = $request->file('site_logo');
            $destinationPath = '/uploads/generalSetting/';
            $filename        = 'logo.' . $file->getClientOriginalExtension();
            $request->file('site_logo')->move(public_path().$destinationPath, $filename);
            $GeneralSetting->site_logo=$filename;
        }
        $GeneralSetting->showLogo_inSign = $showLogo_inSign;

        $GeneralSetting->showImage_Background = $showImage_Background;
        if ($request->hasFile('signIn_backgroundImage')) {
            $file            = $request->file('signIn_backgroundImage');
            $destinationPath = '/uploads/generalSetting/';
            $filename        = 'background.' . $file->getClientOriginalExtension();
            $request->file('signIn_backgroundImage')->move(public_path().$destinationPath, $filename);
            $GeneralSetting->signIn_backgroundImage=$filename;
        }
        $GeneralSetting->app_title = $app_title;
        $GeneralSetting->language = $language;
        $GeneralSetting->timezone = $timezone;
        $GeneralSetting->dateFormat = $dateFormat;
        $GeneralSetting->timeFormat = $timeFormat;
        $GeneralSetting->currency = $currency;
        $GeneralSetting->currency_symbol = $currency_symbol;
        $GeneralSetting->currency_position = $currency_position;
        $GeneralSetting->row_per_page = $row_per_page;
        $GeneralSetting->save();

        Session::flash('success', "General setting has been updated");
        return redirect()->back();
    }

}
