<?php

use App\Http\Controllers\{AuthController, CartController, InvoiceController, MaterialController, UserController};
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

Route::get('/', function () {
    return view('welcome');
})->name("dashboard");
Route::middleware(['auth'])->group(function () {
    Route::get('profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::post('profile/update/{id}/', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('users', UserController::class);
    Route::resource('material', MaterialController::class)->except("show");

    Route::controller(CartController::class)->group(function () {
        Route::post('cart', 'addToCart')->name('cart.addToCart');
        Route::post('cart/destroy/{id}', 'destroy')->name('cart.destroy');
        Route::post('cart/increase/{id}', 'increase')->name('cart.increase');
        Route::post('cart/decrease/{id}', 'decrease')->name('cart.decrease');
        Route::post('cart/setQuantity/{id}', 'setQuantity')->name("setQuantity");
        Route::post('cart/setPrice/{id}', 'setPrice')->name("setPrice");
        Route::post('cart/pay', 'pay')->name('cart.pay');
    });
    Route::controller(InvoiceController::class)->group(function () {
        Route::post('invoice', 'addToCart')->name('invoice.addToCart');
        Route::post('invoice/destroy/{id}', 'destroy')->name('invoice.destroy');
        Route::post('invoice/increase/{id}', 'increase')->name('invoice.increase');
        Route::post('invoice/decrease/{id}', 'decrease')->name('invoice.decrease');
        Route::post('invoice/setQuantity/{id}', 'setQuantity')->name("setQuantity");
        Route::post('invoice/setPrice/{id}', 'setPrice')->name("setPrice");
        // Route::post('invoice/pay', 'pay')->name('cart.pay');
    });
    // Route::get('cart', 'index')->name('cart.index');
    Route::resource('invoice', InvoiceController::class);
});
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::post('forget-password', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');
