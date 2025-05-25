<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', fn() => view('home'));
Route::get('/newsletters', [NewsletterController::class, 'index'])
     ->name('newsletters.index');

require __DIR__.'/auth.php'; // login/register/password reset

// All routes below require authentication
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))
         ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');

    // Newsletter subscriptions
    Route::post('/newsletters/{newsletter}/subscribe', [NewsletterController::class, 'subscribe'])
         ->name('newsletters.subscribe');
    Route::post('/newsletters/{newsletter}/unsubscribe', [NewsletterController::class, 'unsubscribe'])
         ->name('newsletters.unsubscribe');
});
