<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserSessionController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [UserSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [UserSessionController::class, 'create']);

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::resource('books.review', ReviewController::class)
    ->scoped(['review' => 'book'])
    ->only(['create', 'store']);

