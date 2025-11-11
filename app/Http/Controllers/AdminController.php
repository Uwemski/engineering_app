<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
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

    //a function to edit roles
    public function edit(Request $request, $id) {
        //confirm and find id
        $user = User::findOrFail($id);
        //validate
        $data = $request->validate([
            'role' => 'required|in:admin,engineer,client' 
        ]);
        //update
        // dd($data);

        $user->update($data);
        
        // //redirect back with error message
        return redirect()->back()->with('success', 'role updated successfully');
    }

    public function viewOrders(){
        //find
        // $orders= OrderItem::with('order')->get();
        $orders = Order::with('orderItems.product')
                    ->where('payment_status', 'paid')
                    ->get();
        
        // dd($orders);
        return view('admin.orders', compact('orders'));

    }

}
