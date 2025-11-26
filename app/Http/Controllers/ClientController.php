<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //dashboard
    public function index() {
        return view('client.dashboard');
    }

    //view Order
    public function viewOrder() {

        $orders = Auth::user()->orders()
                    ->with('orderItems.product')
                    ->where('payment_status', 'paid')
                    ->latest()
                    ->get();

        // $ord = Order::where('user_id', $user)->get();
        // dd($orders);
        return view('client.orders', compact('orders'));
    }

    public function orderHistory() {

        $id = Auth::user()->id;

        $orders = Order::where('user_id', $id)
                    ->where('payment_status', 'pending')
                    ->with('orderItems.product')
                    ->get();
    
        return view('client.orders', compact('orders'));
        
    }

}
