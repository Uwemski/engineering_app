<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Enquiry;
use App\Models\Quotation;
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

        $users = User::paginate(10);

        return view('admin.users', compact('users', 'userAmount'));
    }

    //a function to edit roles ['faulty']
    public function edit(Request $request, $id) {
        // dd('iiiisisisis');
        
        //confirm and find id
        $user = User::findOrFail($id);
        // //validate
        $data = $request->validate([
            'role' => 'required|in:admin,engineer,client' 
        ]);
        //update
        // dd($data);

        $u = $user->update([
            'role' => $data['role']
        ]);

        dd($u);
        // if($u){
        //     return redirect()->back()->with('success', 'order status updated successfully');
        // } else {
        //     return redirect()->back()->with('error', 'Error encountered, please try again!');
        // }
        // //redirect back with error message
    }

    public function viewOrders(){
        // $orders= OrderItem::with('order')->get();
        $orders = Order::with('orderItems.product')
                    ->where('payment_status', 'paid')
                    ->latest()
                    ->simplePaginate(10);
        
        return view('admin.orders', compact('orders'));
    }

    //function to  update status of an order
    public function updateOrderStatus(Request $request, $id) {
        // dd('ssasasa');
        $order = Order::findOrFail($id);
        
        $data = $request->validate([
            "status" => "required|in:pending,in_production,completed,delivered" 
        ]);

        // dd($data ); working like Saka
        $s = $order->update($data);

        $order->save();
        
        if($s) {
            return redirect()->back()->with('success', 'order status updated successfully');
        } else {
            return redirect()->back()->with('error', 'Error encountered, please try again!');
        }

    }

    //method to view quote requests
    public function show_quotations(){
        $quotations = Quotation::latest()->simplePaginate(2);

        return view('admin.quotations', compact('quotations'));
        // dd($quotations);
    }

    //method to view enquiries
    public function show_enquiries() {
        $enquiries = Enquiry::latest()->simplePaginate();

        return view('admin.enquiries', compact('enquiries'));
    }

}
