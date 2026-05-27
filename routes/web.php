<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

// ─── Authentication ───────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Public Pages ─────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/brand', fn() => view('brand'))->name('brand');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// ─── Product ──────────────────────────────────────────────
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// ─── Cart ─────────────────────────────────────────────────
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// ─── Payment ──────────────────────────────────────────────
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::get('/order-success', [PaymentController::class, 'success'])->name('order.success');

// ─── Admin ────────────────────────────────────────────────
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/customers', fn() => view('admin.customers'))->name('admin.customers');
Route::get('/admin/orders', fn() => view('admin.orders'))->name('admin.orders');

// ─── Admin Products ───────────────────────────────────────
Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
Route::get('/admin/add-product', [AdminProductController::class, 'create'])->name('admin.add-product');
Route::post('/admin/store-product', [AdminProductController::class, 'store'])->name('admin.store-product');
Route::get('/admin/edit-product/{id}', [AdminProductController::class, 'edit'])->name('admin.edit-product');
Route::put('/admin/update-product/{id}', [AdminProductController::class, 'update'])->name('admin.update-product');
Route::delete('/admin/delete-product/{id}', [AdminProductController::class, 'destroy'])->name('admin.delete-product');

// ─── Admin Brands ─────────────────────────────────────────
Route::get('/admin/brands', [AdminBrandController::class, 'index'])->name('admin.brands');
Route::get('/admin/add-brand', [AdminBrandController::class, 'create'])->name('admin.add-brand');
Route::post('/admin/store-brand', [AdminBrandController::class, 'store'])->name('admin.store-brand');
Route::get('/admin/edit-brand/{id}', [AdminBrandController::class, 'edit'])->name('admin.edit-brand');
Route::put('/admin/update-brand/{id}', [AdminBrandController::class, 'update'])->name('admin.update-brand');
Route::delete('/admin/delete-brand/{id}', [AdminBrandController::class, 'destroy'])->name('admin.delete-brand');