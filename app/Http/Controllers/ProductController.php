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
            "description"=> "required|min:2|max:100",
            "price" => "required|numeric|min:0",
            "stock_quantity" => "required|integer|min:0",
            "image" => "nullable|mimes:jpg,png,jpeg,pdf|max:10025",
        ]);

        //Adviced to strip name and not values
       $data['name'] = strip_tags($data['name']);

        // dd($data);

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            // The 'uploads' directory will be created inside storage/app/ by default.
            // You can also specify a different disk, e.g., Storage::disk('public')->putFile('uploads', $request->file('file_input_name'));
            // The 'public' disk stores files in storage/app/public/.
            // To make files in storage/app/public/ accessible via URL, run 'php artisan storage:link'.
            $data['image'] = $path;
            // Store the file path in your database if needed
            // $model->file_path = $path;
            // $model->save();
        }

        //save
        $product = Product::create($data);
        if($product){
            return redirect()->back()->with('success', 'product has been uploaded successfully');
        }else{
            return redirect()->back()->with('error', 'Error encountered, please try again!');
        }

    }

    //read product
    public function product_index() {
        $product = Product::all();

        return view('admin.products', compact('product'));
    }
    //edit product 

    //update product

    //delete product 
}
