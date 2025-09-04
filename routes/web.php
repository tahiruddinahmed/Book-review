<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserSessionController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Authentication
Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [UserSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [UserSessionController::class, 'store']);
});

Route::post('/logout', [UserSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

    
// public route
Route::resource('books', BookController::class)->only(['index', 'show']);

// Protected route
Route::resource('books.review', ReviewController::class)
    ->scoped()
    ->only(['store', 'create', 'edit', 'update', 'destroy'])
    ->middleware('auth');

