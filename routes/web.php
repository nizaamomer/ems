<?php

use App\Http\Controllers\{AuthController, UserController};
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
});
Route::get('login', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::post('forget-password', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');
