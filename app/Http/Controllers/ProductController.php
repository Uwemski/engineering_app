<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    //a function to return view
    public function create() {
        return view('admin.create_product');
    }

    //PRODUCT CRUD
    //create product
    public function store(Request $request) {
        // dd('Mastery is thhe goal'); working 

        $data = $request->validate([
            "name" => "required|min:2|max:50",
            "price" => "required|numeric|min:0",
            "quantity" => "required|integer|min:0",
            "image" => "mimes:jpg, png, jpeg, pdf|max:10025",
        ]);

        foreach($data as $d => $k) {
            $data[$d] = strip_tags($k);
        }

        dd($data);



    }

    
    //edit product 

    //update product

    //delete product 
}
