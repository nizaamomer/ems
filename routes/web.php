<?php

use App\Http\Controllers\{ActivityController, AuthController, CartController, InvoiceController, MaterialController, PdfController, ReportController, UserController};
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
        Route::post('cart/decrease/{id}', 'decrease')->name('cart.decrease');
        Route::post('cart/increase/{id}', 'increase')->name('cart.increase');
        Route::post('cart/setQuantity/{id}', 'setQuantity')->name("cart.setQuantity");
        Route::post('cart/setPrice/{id}', 'setPrice')->name("cart.setPrice");
        Route::post('cart/addInvoice', 'addInvoice')->name('cart.addInvoice');
    });
    Route::controller(InvoiceController::class)->group(function () {
        Route::post('inv', 'addToCart')->name('inv.addToCart');
        Route::post('inv/destroyy/{id}', 'destroyy')->name('inv.destroy');
        Route::post('inv/decrease/{id}', 'decrease')->name('inv.decrease');
        Route::post('inv/increase/{id}', 'increase')->name('inv.increase');
        Route::post('inv/setQuantity/{id}', 'setQuantity')->name("inv.setQuantity");
        Route::post('inv/setPrice/{id}', 'setPrice')->name("inv.setPrice");
        Route::post('inv/UpdateInvoice', 'UpdateInvoice')->name('inv.UpdateInvoice');

    });
    // Route::get('cart', 'index')->name('cart.index');
    Route::resource('report', ReportController::class);
    Route::post('/in/increase/{id}/{iId}', [InvoiceController::class, 'increase'])->name('in.increase');
    Route::resource('invoice', InvoiceController::class);
    Route::post('in/{id}', [InvoiceController::class, 'addToCart'])->name('in.addToCart');
});
Route::get('/pdf', [PdfController::class, 'index'])->name('pdf.index');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::post('forget-password', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');
