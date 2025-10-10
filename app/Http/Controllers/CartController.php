<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request, $id) {
        $id = Product::findOrFail($id);
        dd($id);
    }
}
