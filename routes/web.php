<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::get('/logout', function () {
    auth()->logout();
    Session()->flush();

    return redirect(route('home'));
})->name('logout');

Route::get('/them-vao-gio-hang/{product_id?}', [CartController::class, 'addToCart'])->name('cart.add');
