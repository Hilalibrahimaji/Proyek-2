<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;



// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'sendMessage'])->name('contact.send');

Route::middleware(['auth', ])->prefix('admin')->group(function () {
    Route::get('/contact/messages', [ContactController::class, 'adminMessages'])->name('admin.contact.messages');
    Route::post('/contact/messages/{id}/read', [ContactController::class, 'markAsRead'])->name('admin.contact.markRead');
    Route::delete('/contact/messages/{id}/delete', [ContactController::class, 'deleteMessage'])->name('admin.contact.delete');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes - Harus Login
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{id}/add-to-cart', [ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); //
    Route::get('/my.orders', [OrderController::class, 'myOrders'])->name('my.orders');
    Route::get('/my-orders/{orderNumber}', [OrderController::class, 'show'])->name('my.orders.show');
    
});

// Admin Routes - Harus Login sebagai Admin 
Route::middleware(['auth',  ])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/products/{id}/update', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}/delete', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::delete('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/contact-messages', [ContactController::class, 'adminMessages'])->name('admin.contact.messages');
    Route::get('/contact-read/{id}', [ContactController::class, 'markAsRead'])->name('admin.contact.read');
    Route::get('/contact-delete/{id}', [ContactController::class, 'deleteMessage'])->name('admin.contact.delete');
});

// Cart Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel/{orderId}', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    Route::get('/checkout/failed/{order}', [CheckoutController::class, 'failed'])
    ->name('checkout.failed');

Route::post('/midtrans/callback', [MidtransController::class, 'callback']);


});

Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order_number}', [OrderController::class, 'show'])
        ->name('orders.show');
});


