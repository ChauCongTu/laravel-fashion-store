<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('/{slug}-{id}', [ProductController::class, 'show'])->where(['slug' => '.+', 'id' => '[0-9]+'])->name('product.show');

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
Route::get('/destroy-cart', function () {
    session()->forget('cart');
    return redirect()->back()->with('msg', 'Hủy bỏ giỏ hàng thành công');
})->name('cart.destroy');
