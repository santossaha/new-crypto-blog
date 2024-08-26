<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    
    public function index(){

        return view("Frontend.pages.index");
    }

    public function about(){

        return view("Frontend.pages.about");
    }

    public function service(){


        $services = ServicesModel::all();

        return view("Frontend.pages.service",compact('services'));
}
public function service_details($slug){

    $details = ServicesModel::where('slug',$slug)->first();

    $another_service = ServicesModel::where('slug','<>',$slug)->get();

    return view('Frontend.pages.service-details',compact('details','another_service'));


}


public function contact(){



    return view("Frontend.pages.contact_us");

}

public function asylum(){



return view("Frontend.pages.asylum");

}










}
