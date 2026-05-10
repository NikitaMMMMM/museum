<?php

use Illuminate\Support\Facades\Route;

// Маршрутизация
Route::get('/', fn () => view('pages.index'))->name('pages.index');
Route::get('/about', fn () => view('pages.about'));
Route::get('/exhibits', fn () => view('pages.exhibits'))->name('pages.exhibits');
Route::get('/exhibit', fn () => view('pages.exhibit'))->name('pages.exhibit');
Route::get('/history', fn () => view('pages.history'))->name('pages.history');
Route::get('/login', fn () => view('pages.login'))->name('pages.login');
Route::get('/register', fn () => view('pages.register'))->name('pages.register');
Route::get('/profile', fn () => view('pages.profile'))->name('pages.profile');

