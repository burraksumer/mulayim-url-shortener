<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

// Authentication routes
require __DIR__.'/auth.php';

// Dashboard route
Route::get('/dashboard', [ShortUrlController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Edit and Remove URL routes
Route::get('/url/edit/{id}', [ShortUrlController::class, 'edit'])->middleware(['auth'])->name('edit.url');
Route::delete('/url/remove/{id}', [ShortUrlController::class, 'remove'])->middleware(['auth'])->name('remove.url');
Route::patch('/url/update/{id}', [ShortUrlController::class, 'update'])->middleware(['auth'])->name('update.url');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// URL Shortening routes
Route::get('/', [ShortUrlController::class, 'index'])->name('welcome');
Route::post('/shorten', [ShortUrlController::class, 'shorten'])->name('shorten.url');
Route::get('/{shortUrl}', [ShortUrlController::class, 'redirect']);


