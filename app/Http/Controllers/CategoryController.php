<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // a public function to view form
    public function index() 
    {
        return view('admin.create_category');
    }

    //a function to store 
    public function store(StoreCategoryRequest $request)
    {
        //
        $data = $request->validated();

        //generate slug
        $slug = Str::slug($data['name']);

        //cheeck if slug exist
        $count = Category::where('slug', "$slug")
                ->orWhere('slug', 'LIKE', "{$slug}-%")
                ->count();
        //add it
        if($count > 0){
            $slug = $slug . '-' . ($count + 1);
        }
        $data['slug'] = $slug;

        $c = Category::create($data);

        if($c){
            return redirect()->back()->with('success', 'Category created successfully');
        }
        
        return redirect()->back()->with('error', 'Error encountered, please try again');
        
    }
}
