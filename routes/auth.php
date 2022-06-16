<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Seller\AuthenticatedSellerSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Seller\RegisteredSellerController;
use App\Http\Controllers\Auth\Seller\SellerPasswordResetLinkController;
use App\Http\Controllers\Auth\Seller\NewSellerPasswordController;
use App\Http\Controllers\Auth\Seller\VerifySellerEmailController;
use App\Http\Controllers\Auth\Seller\SellerEmailVerificationNotificationController;
use App\Http\Controllers\Auth\Seller\SellerEmailVerificationPromptController;


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

    // for Sellers
    Route::get('seller/register', [RegisteredSellerController::class, 'create'])
            ->name('seller.register');

    Route::post('seller/register', [RegisteredSellerController::class, 'store']);

    Route::get('seller/login', [AuthenticatedSellerSessionController::class, 'create'])
    ->name('seller.login');

    Route::post('seller/login', [AuthenticatedSellerSessionController::class, 'store']);

    Route::get('seller/forgot-password', [SellerPasswordResetLinkController::class, 'create'])
    ->name('seller.password.request');

    Route::post('seller/forgot-password', [SellerPasswordResetLinkController::class, 'store'])
    ->name('seller.password.email');

    Route::get('seller/reset-password/{token}', [NewSellerPasswordController::class, 'create'])
    ->name('seller.password.reset');

    Route::post('seller/reset-password', [NewSellerPasswordController::class, 'store'])
    ->name('seller.password.update');

});

Route::middleware(['auth,auth'])->group(function () {

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

});

// for user only

Route::middleware(['auth:web'])->group(function () {

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');


    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});


// for Sellers only

Route::middleware(['auth:seller'])->group(function () {

    Route::post('seller/logout', [AuthenticatedSellerSessionController::class, 'destroy'])
                ->name('seller.logout');

    Route::get('verify-email', [SellerEmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('seller/verify-email/{id}/{hash}', [VerifySellerEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('seller.verification.verify');

    Route::post('email/verification-notification', [SellerEmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
});

