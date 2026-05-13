<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Events\NewOrderRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\CartService;

use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(Cartservice $cartService){
        $this->cartService = $cartService;
    }
    

    public function add(Request $request, $id)
    {    
        // find the id
        $product = Product::findOrFail($id);

        $quantity = $request->input('quantity', 1); 
        
        $this->cartService->add($product, $quantity);
    
        return redirect()->back()->with('success', 'Product added successfully');//anything after return doesn't work
    }

    public function index(){

        $cart = $this->cartService->getCart();
        $subtotal = $this->cartService->subtotal();
        $count = $this->cartService->count();
        return view('client.cart', compact('cart', 'subtotal', 'count'));
    }

    //a method to update cart
    public function update(Request $request) {

        // info($request->all());

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $this->cartService->update($validated['product_id'], $validated['quantity']);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    //a method to delete cart
    public function remove($id){
    
        $this->cartService->remove($id);
        // return response()->json(["success" => 1]); if we use ajax but i'm having issue with the ajax method
        return redirect()->back()->with('success', 'Item has been deleted successfully');
    }

    public function clear(){
        $this->cartService->clear();
        return redirect()->route('cart.test')->with('succes', 'Cart cleared successfully');
    }

    public function checkout() {
        $cart = $this->cartService->getCart();
        $itemCount = $this->cartService->count();
        $subtotal = $this->cartService->subtotal();

        //check if cart is empty
        if(empty($cart)){
            return redirect()->route('cart.test')->with('error', 'cart is empty');
        }

        return view('cart.checkout', compact('cart', 'subtotal', 'itemCount'));
    }
}