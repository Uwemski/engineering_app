<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    //a function to show a product
    public function show(Product $product) 
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    //a function to return view
    public function create() {
        //this is not best practice
        $categories = Category::all();

        return view('admin.create_product', compact('categories'));
    }

    //PRODUCT CRUD
    //create product
   public function store(StoreProductRequest $request)
    {
        // dd($request);

        //use try-catch here to get catch errors and move validation request for cleaner controller
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $count = Product::where('slug', "$slug")
                ->orWhere('slug', 'LIKE', "{$slug}-%")
                ->count();
        //add it
        if($count > 0){
            $slug = $slug . '-' . ($count + 1);
        }

        $data['slug'] = $slug;
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        $data['image'] = $imagePath;
        
        Product::create($data);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    //read product
    public function product_index() {
        $product = Product::with('category')->paginate(10);

        if($product->isEmpty()) {
            return view('admin.products')
                ->with('product', $product)
                ->with('empty', 'Products are empty at the moment');
        }

        return view('admin.products', compact('product'));
    }

    //a function to ensure visitors view company's product
    public function guestIndex() {
        $products = Product::latest()->get();

        
        return view('products', compact('products'));
    }
    
    //edit product
    public function edit($id) {
        $pro = Product::findOrFail($id);

        if(!$pro) {
            // return redirect()->back()->with('invalid Id', 'invalid Id');
            return response()->json([
                'success' => false,
                'message' => "Invalid id, product doesn't exist"
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $pro
        ]);
        // return view('admin.edit_product', compact('pro'));
    }

    //update product
    public function update(Request $request, $id) {
         //check id
        $product = Product::findOrFail($id);
        //validate
        $data = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'description' => 'required|string|min:3|max:70',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'    => 'nullable|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // sanitize only string fields
        $data['name'] = strip_tags($data['name']);

        // begin transaction
        DB::beginTransaction();

        try {
            // handle image upload (if present)
            if ($request->hasFile('image')) {
                // stores in storage/app/public/products
                 if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $path = $request->file('image')->store('products', 'public');
                $data['image'] = $path;
            }

            // create product
            $product->update($data);

            DB::commit();

            // return redirect()->route('product.create')->with('success', 'Product created successfully.');
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!',
                'data' => $product
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            // remove uploaded file if it exists (cleanup)
            if (! empty($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Log detailed error for debugging (not shown to the user)
            Log::error('Product store failed: '.$e->getMessage(), [
                'exception' => $e,
                'input' => $request->except('image'),
            ]);

            // Return back with old input + friendly error message
            return response()->json([
                'success' => false,
                'error' => 'Failed to create product. Please try again or contact support.'
            ]);
        }
    }

    //delete product
    public function delete($id) {
        $pro = Product::findOrFail($id);

        $y= $pro->delete();
        if($y){
            return redirect()->back()->with('success', 'Product has been deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Error encountered, please try again');
        }
    }

    //a method to search product
    public function search(Request $request) {

        $data = $request->validate([
            'name' => 'required|min:2'
        ]);

        //striptag
        $data['name']= strip_tags($data['name']);
        
        $products = Product::where("name", "like", "%{$data['name']}%")->get();
        // dd($products);

        if ($products ->isEmpty() ) {
            return redirect()->back()->with('error', 'Product doesnt exist');
        }
        
        return view('client.test', compact('products'));
        //this is wrong, the products needs to be passed
        // if ($in->isNotEmpty()){
        //     return redirect()->back()->with('success', 'product exist!!');
        // }else{
        //     return redirect()->back()->with('error', 'Product doesnt exist');
        // }
    }
    
}
