<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Illuminate\Http\Request $request) => $request->user());

    // Route::post('/logout', function (Illuminate\Http\Request $request) {
    //     $request->user()->currentAccessToken()->delete();
    //     return response()->json(['message' => 'Успешный выход']);
    // });
});

// Route::get('/profile', fn () => view('pages.profile'))->name('pages.profile');