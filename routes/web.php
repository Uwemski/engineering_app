<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user-page', function () {
    return view('user-page');
})->middleware('is_Admin');

Route::get('/about', function() {
    return view();
});

Route::get('/contact', function() {
    return view();
});

//route for product page i.e a public catalogue. No middleware
Route::get('/products', function() {
    return view();
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users', [AdminController::class, 'show'])->name('admin.users');
    //CRUD routes for product goes below
    //C
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    //R
    Route::get('product/view', [ProductController::class, 'product_index'])->name('product.index');
    //U
    Route::post('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    //D
    Route::post('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    //CRUD routes for oders below
    
    //Route::get('admin/orders', [AdminController::class, 'index'])->name('admin.orders');
    
    //a route to update role
    ROute::put('/admin/update/{id}', [AdminController::class, 'edit'])->name('users.edit');
    //a route to view sales[like inventory] will be nice
});

//routes for engineer
Route::middleware(['role:engineer'])->group(function () {
    //dshboard
    Route::get('engineer/dashboard', [EngineerController::class, 'index'])->name('engineer.dashboard');
    //product
    Route::get('engineer/dashboard', [EngineerController::class, 'index'])->name('engineer.product');
    //orders
    //sehow route related to orders
});

Route::middleware(['role:client'])->group(function () {
    //dashboard
    Route::get('client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    //orders 
    Route::post('client/order', [ClientController::class, 'create'])->name('client.order');
    //profile
});

Route::get('/guest',[ProductController::class, 'guestIndex']);
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');

require __DIR__.'/auth.php';
