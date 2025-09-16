<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\ClientController;

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
    Route::post('admin/product/create', [AdminController::class, 'create'])->name('admin.product_create');

    //CRUD routes for oders below
    //Route::get('admin/orders', [AdminController::class, 'index'])->name('admin.orders');

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

require __DIR__.'/auth.php';
