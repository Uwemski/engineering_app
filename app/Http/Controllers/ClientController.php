<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //dashboard
    public function index() {
        return view('client.dashboard');
    }
}
