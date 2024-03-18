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
    Route::post('/login', [AuthenticationController::class, 'login'])
        ->name('login.post');

    Route::view('/register', 'auth.register')
        ->name('register');
    Route::post('/register', [AuthenticationController::class, 'register'])
        ->name('register.post');

    Route::view('/forgot-password', 'auth.forgot-password')
        ->name('password.forgot');
    Route::post('/forgot-password', [AuthenticationController::class, 'sendPasswordReset'])
        ->name('password.forgot.post');
    Route::get('/reset-password/{token}', [AuthenticationController::class, 'resetPasswordForm'])
        ->name('password.reset');
    Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {

    Route::prefix('/email/verify')->group(function () {
        Route::view('/', 'auth.verify-email')
            ->name('verification.notice');
        Route::get('/resend', [AuthenticationController::class, 'resendEmailVerification'])
            ->name('verification.resend');
        Route::get('/{id}/{hash}', [AuthenticationController::class, 'verifyEmail'])
            ->middleware('signed')
            ->name('verification.verify');
    });

    Route::middleware('verified')->group(function () {
        Route::view('protected', 'protected')
            ->name('protected');
    });
});

Route::view('/', 'home')->name('home');
