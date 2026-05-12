<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;

Route::get('/', function () {
    return view('layout-1-blueprint');
})->name('home');

Route::get('/user-page', function () {
    return view('user-page');
})->middleware('is_Admin');

Route::get('/about', function() {
    return view();
})->name('about');

Route::get('/contact', function() {
    return view();
});

// route for product page i.e a public catalogue. No middleware

Route::get('/products', function() {
    return view('products');
})->name('products');

Route::get('/news/index', function() {
    return view();
})->name('news.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('admin/users', [AdminController::class, 'show'])->name('admin.users');
    //CRUD routes for product goes below
    //C
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    //R
    Route::get('product/view', [ProductController::class, 'product_index'])->name('product.index');
    //U
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
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
    Route::get('admin/quotations', [AdminController::class, 'show_quotations'])->name('admin.quotations.show');
    //a route for admin to view messages
    Route::get('admin/messages', [AdminController::class, 'show_enquiries'])->name('admin.enquiries.show');
    //
    Route::get('admin/edit-quote/{Quotation}', [AdminController::class, 'edit_quotation'])->name('admin.edit.quotation');
    Route::POST('admin/update-quote/{Quotation}', [AdminController::class, 'update_quotation'])->name('admin.quotations.update');
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
    Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    //orders 
    Route::post('client/order', [ClientController::class, 'create'])->name('client.order');
    //view order
    Route::get('client/order/view', [ClientController::class, 'viewOrder'])->name('client.order.view');
    //history
    Route::get('client/order/view-history', [ClientController::class, 'orderHistory'])->name('client.order.view-history');
    //profile
    
});

    //QuotationController //both client and admin 
    //should user have account to send quotation? 
    Route::get('/client/quotation', [QuotationController::class, 'create'])->name('quotation.index');
    Route::post('/client/quotation', [QuotationController::class, 'store'])->name('quotation.store');

//it's not good that these routes are not grouped and not controlled for security purposes. fix that
Route::get('/guest',[ProductController::class, 'guestIndex'])->name('cart.test');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::POST('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::POST('/cartUpdate', [CartController::class, 'cartUpdate'])->name('cart.update');

Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::DELETE('/cartDelete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/processCheckout', [PaymentController::class, 'checkoutProcess'])->name('cart.process.checkout');

Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');
Route::post('/product/search', [ProductController::class, 'search'])->name('product.search');

//this route is for the enquiry section of the index or a hyperlink to contact the company
Route::get('/contact-page', [EnquiryController::class, 'index'])->name('enquiry.index');
Route::post('guest/contact-us', [EnquiryController::class, 'store'])->name('enquiry.store');

//CategoryController
Route::get('/create/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('create/category', [CategoryController::class, 'store'])->name('category.store');





require __DIR__.'/auth.php';
