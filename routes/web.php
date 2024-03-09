<?php

use App\Http\Controllers\{
    AuthController,
    CartController,
    DashboardController,
    InvoiceController,
    MaterialController,
    ReportController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::post('profile/update/{id}/', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('users', UserController::class)->middleware('admin');
    Route::resource('material', MaterialController::class)
        ->except('show')->middleware('recorder:index,create,store');
    Route::resource('invoice', InvoiceController::class)->except(['store', 'update'])->middleware('recorder:index,create');
    Route::controller(CartController::class)->group(function () {
        Route::post('cart', 'addToCart')->name('cart.addToCart')->middleware('recorder:addToCart');
        Route::post('cart/destroy/{id}', 'destroy')->name('cart.destroy')->middleware('recorder:destroy');
        Route::post('cart/decrease/{id}', 'decrease')->name('cart.decrease')->middleware('recorder:decrease');
        Route::post('cart/increase/{id}', 'increase')->name('cart.increase')->middleware('recorder:increase');
        Route::post('cart/setQuantity/{id}', 'setQuantity')->name("cart.setQuantity")->middleware('recorder:setQuantity');
        Route::post('cart/setPrice/{id}', 'setPrice')->name("cart.setPrice")->middleware('recorder:setPrice');
        Route::post('cart/addInvoice', 'addInvoice')->name('cart.addInvoice')->middleware('recorder:addInvoice');
    });
    Route::controller(InvoiceController::class)->group(function () {
        Route::post('inv', 'addToCart')->name('inv.addToCart')->middleware('recorder:addToCart');
        Route::post('inv/destroyy/{id}', 'destroyy')->name('inv.destroy')->middleware('recorder:destroyy');;
        Route::post('inv/decrease/{id}', 'decrease')->name('inv.decrease')->middleware('recorder:decrease');
        Route::post('inv/increase/{id}', 'increase')->name('inv.increase')->middleware('recorder:increase');
        Route::post('inv/setQuantity/{id}', 'setQuantity')->name("inv.setQuantity")->middleware('recorder:setQuantity');
        Route::post('inv/setPrice/{id}', 'setPrice')->name("inv.setPrice")->middleware('recorder:setPrice');
        Route::post('inv/UpdateInvoice', 'UpdateInvoice')->name('inv.UpdateInvoice')->middleware('recorder:UpdateInvoice');
    });
    Route::get('/report/invoice', [ReportController::class, 'invoice'])->name('report.invoice')->middleware('viewer:invoice');
    Route::post('/report/invoice', [ReportController::class, 'invoice'])->name('report.invoice.post')->middleware('viewer:invoice');;
    Route::get('/report/activity', [ReportController::class, 'activity'])->name('report.activity')->middleware('viewer:activity');
});
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::post('forget-password', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');
