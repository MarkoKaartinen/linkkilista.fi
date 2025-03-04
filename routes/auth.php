<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('kirjaudu', 'auth.login')
        ->name('login');

    Volt::route('rekisteroidy', 'auth.register')
        ->name('register');

    Volt::route('unohtunut-salasana', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('nollaa-salasana/{token}', 'auth.reset-password')
        ->name('password.reset');

});

Route::middleware('auth')->group(function () {
    Volt::route('vahvista-sahkoposti', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('vahvista-sahkoposti/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('vahvista-salasana', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('ulos', App\Livewire\Actions\Logout::class)
    ->name('logout');
