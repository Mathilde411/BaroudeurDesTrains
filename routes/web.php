<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
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
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'loginView'])
        ->name('login');
    Route::get('/loginImt', [AuthenticationController::class, 'cerbairLogin'])
        ->name('login.cerbair');
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
        ->name('password.reset.post');
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

        Route::prefix('conversation/{conversation}')->group(function () {
            Route::get('/', [ConversationController::class, 'display'])
                ->name('conversation');
            Route::post('/', [ConversationController::class, 'send'])
                ->name('sendMessage');
        });

        Route::get('profile/{user}', [ProfileController::class, 'display'])
            ->name('profile');
        Route::post('profile/{user}', [ProfileController::class, 'modifyProfile'])
            ->name('profile.post');

        Route::prefix('game')->group(function () {
            Route::get('/', [GameController::class, 'games'])
                ->name('games');

            Route::post('/', [GameController::class, 'createGame'])
                ->name('game.create');

            Route::get('{game:slug}', [GameController::class, 'game'])
                ->name('game');

        });
    });

});

Route::view('/', 'home')->name('home');
