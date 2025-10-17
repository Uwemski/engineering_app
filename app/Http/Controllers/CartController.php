<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request, $id) {
        //find the id
        $product = Product::findOrFail($id);

        //use session helper
        $cart = session('cart', []);

         // Add or update the product in the cart
        $cart[$id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'image' => $product->image,
            'description' => $product->description
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added successfully');//anything after return doesn't work
        // dd($cart);
    }
}
