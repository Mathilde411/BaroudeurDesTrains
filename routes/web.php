<?php

use App\Http\Controllers\AuthenticationController;
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

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')
        ->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);

    Route::view('/register', 'auth.register');
    Route::post('/register', [AuthenticationController::class, 'register'])
        ->name('register');
    Route::post('/forgot-password', [AuthenticationController::class, 'sendPasswordReset'])->name('forgot-password');
    Route::get('/reset-password/{token}', [AuthenticationController::class, 'resetPasswordForm'])
        ->name('password.reset');
    Route::post('/reset-password', [AuthenticationController::class, 'resetPassword']);
});

Route::middleware('auth')->group(function () {

    Route::prefix('/email/verify')->group(function () {
        Route::view('/', 'auth.verify-email')->name('verification.notice');
        Route::get('/resend', [AuthenticationController::class, 'resendEmailVerification']);
        Route::get('/{id}/{hash}', [AuthenticationController::class, 'verifyEmail'])
            ->middleware('signed')
            ->name('verification.verify');
    });

    Route::middleware('verified')->group(function () {

    });
});

Route::view('/', 'home');
