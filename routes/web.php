<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\QuotationController;

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

//components.admin-layout
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//temporary
// Route::get('/dashboard', function () {
//     return view('admin.quotations');
// })->middleware(['auth', 'verified'])->name('dashboard');




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
    
    //Route::get('admin/orders', [AdminController::class, 'index'])->name('admin.orders');
    
    //a route to update role
    ROute::put('/admin/update/{id}', [AdminController::class, 'edit'])->name('users.edit');
    //a route to view sales[like inventory] will be nice

    //orders crud
    Route::get('/orders/view', [AdminController::class, 'viewOrders'])->name('admin.orders.show');

    Route::POST('/orders/update/{id}', [AdminController::class, 'updateOrderStatus'])->name('order.update');

    //a route for admin to view quotation
    Route::get('admin/quotations', [AdminController::class, 'show_quotations'])->name('quotations.show');
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
    //view order
    Route::get('client/order/view', [ClientController::class, 'viewOrder'])->name('client.order.view');
    //history
    Route::get('client/order/view-history', [ClientController::class, 'orderHistory'])->name('client.order.view-history');
    //profile

    //QuotationController //both client and admin
    Route::get('/client/quotation', [QuotationController::class, 'index'])->name('quotaion.index');
    Route::post('/client/quotation', [QuotationController::class, 'store'])->name('quotation.store');
});

//it's not good that these routes are not grouped and not controlled for security purposes. Find way to fix that
Route::get('/guest',[ProductController::class, 'guestIndex'])->name('cart.test');
Route::POST('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::POST('/cartUpdate', [CartController::class, 'cartUpdate'])->name('cart.update');

Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::DELETE('/cartDelete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/processCheckout', [CartController::class, 'checkoutProcess'])->name('cart.process.checkout');


Route::get('/payment/callback', [CartController::class, 'handleGatewayCallback'])->name('payment.callback');
Route::post('/product/search', [ProductController::class, 'search'])->name('product.search');

//this route is for the enquiry section of the index or a hyperlink to contact the company
Route::get('/contact-page', [EnquiryController::class, 'index'])->name('enquiry.index');
Route::post('guest/contact-us', [EnquiryController::class, 'store'])->name('enquiry.store');


require __DIR__.'/auth.php';
