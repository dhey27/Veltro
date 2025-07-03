<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Frontend Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductDisplayController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\OrderHistoryController;

// Admin Controllers
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK PENGUNJUNG / USER (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// 🏠 Halaman Beranda
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// 👟 Produk
Route::get('/products', [ProductDisplayController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductDisplayController::class, 'show'])->name('products.show');
Route::get('/cari-produk', [ProductDisplayController::class, 'search'])->name('products.search');
Route::get('/produk-terlaris', [ProductDisplayController::class, 'bestSellers'])->name('products.best-sellers');

// 🛒 Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// 💳 Checkout
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// 📞 Kontak
Route::view('/kontak', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| AUTENTIKASI
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK USER SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    // 🧾 Riwayat Pesanan
    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('myorders.index');

    // 🕓 Riwayat Lengkap
    Route::get('/riwayat', [OrderHistoryController::class, 'index'])->name('order.history');

    // 📤 Upload Bukti Transfer
    Route::get('/payment/upload/{order}', [CheckoutController::class, 'uploadForm'])->name('payment.upload.form');
    Route::post('/payment/upload/{order}', [CheckoutController::class, 'uploadSubmit'])->name('payment.upload.submit');
});


/*
|--------------------------------------------------------------------------
| ROUTES UNTUK ADMIN (prefix: /admin)
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| ROUTES UNTUK ADMIN (prefix: /admin)
|--------------------------------------------------------------------------
*/



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/report', [DashboardController::class, 'report'])->name('admin.report'); // ✅ tambahkan ini

    Route::resource('products', AdminProductController::class)->names('admin.products');
    Route::get('products/out-of-stock', [AdminProductController::class, 'outOfStock'])->name('admin.products.outofstock');

    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update.status');
    Route::put('orders/{order}/approve', [AdminOrderController::class, 'approvePayment'])->name('admin.orders.approve.payment');
    Route::put('orders/{order}/reject-payment', [AdminOrderController::class, 'rejectPayment'])->name('admin.orders.reject.payment');
    Route::delete('orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');

    Route::post('/orders/{id}/approve-payment', [OrderController::class, 'approvePayment'])->name('orders.approve.payment');
});



