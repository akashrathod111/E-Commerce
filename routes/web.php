<?php

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

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('frontend.index');
Route::post('/cart/store/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::resource('add-cart', App\Http\Controllers\CartController::class);
Route::resource('check-out', App\Http\Controllers\CheckoutController::class);
Route::get('/thank-you', function () {
    return view('frontend.cart.thankyou',['cartCount'=> '0']);
})->name('thank-you');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('category', App\Http\Controllers\CategoryController::class);
Route::resource('vendor', App\Http\Controllers\VendorController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);

