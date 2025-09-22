<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //dashboard page
    public function index(){

        return view('admin.dashboard');
    }

    //a function to view all users 
    public function show() {
        $userAmount = User::count();

        $users = User::all();

        return view('admin.users', compact('users', 'userAmount'));
    }

    
}
