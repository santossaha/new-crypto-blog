<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CompanySettingsController extends Controller
{
    public function index(){
        $GeneralSetting = CompanySetting::first();
        return view('Backend.Settings.Company.All',['ID'=>$GeneralSetting->id,'data'=>$GeneralSetting]);
    }

    public function saveCompanySetting(Request $request, $id){
        $this->validate($request, [
            'company_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'website' => 'required',
        ]);

        $company_name = $request->get('company_name');
        $address = $request->get('address');
        $city = $request->get('city');
        $state = $request->get('state');
        $country = $request->get('country');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $website = $request->get('website');
        $gst_vat_number = $request->get('gst_vat_number');

        $update= CompanySetting::findOrFail($id);
        $update->company_name = $company_name;
        $update->address = $address;
        $update->city = $city;
        $update->state = $state;
        $update->country = $country;
        $update->phone = $phone;
        $update->email = $email;
        $update->website = $website;
        $update->gst_vat_number = $gst_vat_number;
        $update->save();

        Session::flash('success', "Company setting has been updated");
        return redirect()->back();
    }

}
