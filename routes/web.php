<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'welcome'] )->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])
    ->middleware(['auth:seller', 'verified.seller'])->name('seller.dashboard');

Route::get('/user/info', function () {
    return view('user_need_confirm');
})->middleware(['auth', 'verified', 'password.confirm'])->name('user.info');

Route::get('/seller/info', function () {
    return view('seller_need_confirm');
})->middleware(['auth:seller', 'verified', 'seller.password.confirm'])->name('seller.info');

require __DIR__.'/auth.php';
