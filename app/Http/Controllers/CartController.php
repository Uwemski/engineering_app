<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request, $id) {
        //find the id
        // dd(session('cart'));
        $product = Product::findOrFail($id);

        //use session helper
        $cart = session('cart', []);

        $quantity = $request->input('quantity', 1); 
        if(isset($cart[$id]) ){
            $cart[$id]['quantity'] += $quantity;
        }else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image, 
                'description' => $product->description
            ];
        }
        
        // dd($cart);

        // Add or update the product in the cart
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added successfully');//anything after return doesn't work
    }

    public function cart(){

        return view('client.cart');
    }

    //a method to update cart
    public function cartUpdate(Request $request) {

        info($request->all());

        $cart = session('cart');

        $cart[$request->product_id]['quantity'] = $request->quantity;
    
        session()->put('cart', $cart);

        return response()->json(["success" => 1]);
    }

    //a method to delete cart
    public function cartDelete($id){
        //find product
        // dd("uefhefhefhefhe"); working like declan rice

        $product = Product::findOrFail($id);

        $cart = session('cart');

        //check if the product is in session  
        if(isset($cart[$id])){
            unset($cart[$id]);
            
            session(['cart' => $cart]);
        }
        // $product->delete(); this will most likely delete the produvt from DB and we don't want that

        // return response()->json(["success" => 1]);
        return redirect()->back()->with('success', 'Item has been deleted successfully');
    }

    public function checkout() {
        dd('kmrmmlmlmlmmpp');
    }
}
