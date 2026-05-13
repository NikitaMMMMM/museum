<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Exhibit\CreateController;
use App\Http\Controllers\Exhibit\DestroyController;
use App\Http\Controllers\Exhibit\EditController;
use App\Http\Controllers\Exhibit\IndexController;
use App\Http\Controllers\Exhibit\ShowController;
use App\Http\Controllers\Exhibit\StoreController;
use App\Http\Controllers\Exhibit\UpdateController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Маршрутизация
Route::get('/', fn() => view('pages.index'))->name('pages.index');

Route::get('/about', fn() => view('pages.about'))->name('pages.about');
Route::get('/history', fn() => view('pages.history'))->name('pages.history');

Route::middleware('guest')->group(function () {
    // Показ формы входа
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Обработка входа
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    // Восстановление пароля
    Route::get('/password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});


Route::prefix('exhibits')->name('exhibits.')->middleware('auth')->group(function () {
    Route::get('/', IndexController::class)->name('index');
    Route::get('/create', CreateController::class)->name('create');
    Route::post('/', StoreController::class)->name('store');
    Route::get('/{slug}', ShowController::class)->name('show');
    Route::get('/{slug}/edit', EditController::class)->name('edit');
    Route::patch('/{slug}', UpdateController::class)->name('update');
    Route::delete('/{slug}', DestroyController::class)->name('destroy');
});

Route::middleware('web')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/auth', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/profile', fn() => view('auth.profile'))->name('auth.profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->name('verification.send');
});

