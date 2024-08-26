<?php

namespace App\Http\Controllers\Backend\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('Backend.blank');
    }

    public function dashboard(){
        return view('Backend.dashboard');
    }

}
