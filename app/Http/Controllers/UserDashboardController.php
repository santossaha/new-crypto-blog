<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function dashboard (){
        return view("Frontend.pages.dashboard.dashboard");
    }
}
