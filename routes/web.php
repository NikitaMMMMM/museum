<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Маршрутизация
Route::get('/', fn () => view('pages.index'))->name('pages.index');
Route::get('/about', fn () => view('pages.about'))->name('pages.about');
Route::get('/exhibits', fn () => view('pages.exhibits'))->name('pages.exhibits');
Route::get('/exhibit', fn () => view('pages.exhibit'))->name('pages.exhibit');
Route::get('/history', fn () => view('pages.history'))->name('pages.history');
Route::get('/login', fn () => view('pages.login'))->name('pages.login');
Route::get('/profile', fn () => view('pages.profile'))->name('pages.profile');

Route::middleware('web')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});