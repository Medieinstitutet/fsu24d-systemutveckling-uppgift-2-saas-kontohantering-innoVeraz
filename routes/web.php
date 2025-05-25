<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'));
Route::get('/newsletters', [NewsletterController::class, 'index'])
     ->name('newsletters.index');
Route::get('/newsletters/{newsletter}', [NewsletterController::class, 'show'])
     ->name('newsletters.show');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))
         ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');

    Route::post('/newsletters/{newsletter}/subscribe', [NewsletterController::class, 'subscribe'])
         ->name('newsletters.subscribe');
    Route::post('/newsletters/{newsletter}/unsubscribe', [NewsletterController::class, 'unsubscribe'])
         ->name('newsletters.unsubscribe');
    
    Route::middleware(['role:subscriber'])->group(function () {
        Route::get('/my-subscriptions', [NewsletterController::class, 'mySubscriptions'])
             ->name('subscriptions.my');
    });
    
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/my-subscribers', [NewsletterController::class, 'mySubscribers'])
             ->name('subscribers.my');
        
        Route::get('/my-newsletter', [NewsletterController::class, 'editMyNewsletter'])
             ->name('newsletter.my.edit');
        Route::put('/my-newsletter', [NewsletterController::class, 'updateMyNewsletter'])
             ->name('newsletter.my.update');
        
        Route::get('/newsletters/create', [NewsletterController::class, 'create'])
             ->name('newsletters.create');
        Route::post('/newsletters', [NewsletterController::class, 'store'])
             ->name('newsletters.store');
        Route::get('/newsletters/{newsletter}/edit', [NewsletterController::class, 'edit'])
             ->name('newsletters.edit');
        Route::put('/newsletters/{newsletter}', [NewsletterController::class, 'update'])
             ->name('newsletters.update');
        Route::delete('/newsletters/{newsletter}', [NewsletterController::class, 'destroy'])
             ->name('newsletters.destroy');
    });
});
