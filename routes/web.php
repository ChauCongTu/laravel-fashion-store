<?php

use App\Http\Controllers\Admin\CategoriesManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/{slug}-{id}.cat', [CategoriesController::class, 'show'])->where(['slug' => '.+', 'id' => '[0-9]+'])->name('category.show');

Route::get('^/{slug}-{id}', [ProductController::class, 'show'])->where(['slug' => '.+', 'id' => '[0-9]+'])->name('product.show');

Route::post('/comment/{reply_id?}', [ProductController::class, 'comment'])->name('product.comment');

Route::get('/dang-nhap', [LoginController::class, 'login'])->name('login');
Route::post('/dang-nhap', [LoginController::class, 'handle'])->name('login');
Route::get('/dang-ky', [RegisterController::class, 'register'])->name('register');
Route::post('/dang-ky', [RegisterController::class, 'handle'])->name('register');
// Route::get('/quen-mat-khau', [ResetPasswordController::class, 'getReset'])->name('reset');
// Route::post('/quen-mat-khau', [ResetPasswordController::class, 'postReset'])->name('reset');
Route::get('/logout', function () {
    auth()->logout();

    return redirect(route('home'));
})->name('logout');

Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
Route::post('/them-vao-gio-hang/{product_id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cap-nhat-gio-hang', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/ap-dung-coupon', [CartController::class, 'applyCoupon'])->middleware('login')->name('cart.coupon');
Route::get('/thanh-toan', [CheckoutController::class, 'getCheckout'])->middleware('login')->name('cart.checkout');
Route::post('/thanh-toan', [CheckoutController::class, 'postCheckout'])->middleware('login')->name('cart.checkout');
Route::post('/cancel/{code}', [CheckoutController::class, 'cancelOrder'])->middleware('login')->name('cart.cancel');
Route::get('/destroy-cart', function () {
    session()->forget('cart');
    return redirect()->back()->with('msg', 'Hủy bỏ giỏ hàng thành công');
})->name('cart.destroy');

Route::prefix('wishlist')->middleware('login')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/remove-from-wishlist/{product_id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

Route::middleware('login')->group(function () {
    Route::get('/tai-khoan-cua-toi.html', [UserController::class, 'myInfo'])->name('users.info');
    Route::post('/tai-khoan-cua-toi.html', [UserController::class, 'editInfo'])->name('users.info');
    Route::post('/doi-anh-dai-dien', [UserController::class, 'changeAvatar'])->name('users.change_avatar');
    Route::get('/don-hang-cua-toi', [UserController::class, 'myOrder'])->name('user.orders');
    Route::get('/chi-tiet-don-hang/{code}.html', [UserController::class, 'orderDetail'])->name('user.orders.detail');
    Route::put('/status/{code}/change/', [CheckoutController::class, 'updateStatus'])->name('user.orders.changeStatus');
});

Route::get('tim-kiem', [SearchController::class, 'search'])->name('search');
Route::prefix('blog')->group(function () {
    Route::get('/', [PostController::class, 'list'])->name('post.list');
    Route::get('/{slug}-{id}', [PostController::class, 'show'])->where(['slug' => '.+', 'id' => '[0-9]+'])->name('post.show');
});

// Admin Route
Route::prefix('/admin')->middleware('adminCheck')->group(function() {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin');
    // Route::resource('/category', CategoriesManagementController::class);
});
// Route::post('/getRevenue', [DashboardController::class, 'getRevenue']);
