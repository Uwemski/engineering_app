<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //dashboard page
    public function index(){

        return view('admin.dashboard');
    }
}
