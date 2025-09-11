<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user-page', function () {
    return view('user-page');
})->middleware('is_Admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users', [AdminController::class, 'show'])->name('admin.users');
    //CRUD routes for product goes below
    //Route::post('admin/product/create', [AdminController::class, 'create'])->name('admin.product_create');

    //CRUD routes for oders below
    Route::get('admin/orders', [AdminController::class, 'index'])->name('admin.orders');

    //a route to view sales[like inventory] will be nice
});

//routes for engineer
Route::middleware('')->group(function () {
    //dshboard
    Route::get('engineer/dashboard', [Admincontroller::class, 'index'])->name('engineer.dashboard');
    //product
    Route::get('engineer/dashboard', [Admincontroller::class, 'index'])->name('engineer.product');
    //orders
    //sehow route related to orders
});

Route::middleware()->group(function () {
    //dashboard
    Route::get('client/dashboard', [AdminController::class, 'index'])->name('client.dashboard');
    //orders 
    Route::post('client/order', [AdminController::class, 'create'])->name('client.order');
    //profile
});

require __DIR__.'/auth.php';
