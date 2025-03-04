<?php

use App\Livewire\Links;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome')
    ->name('home');

Route::get('/@{username}', Profile::class)
    ->name('user.profile');

Route::get('/linkit', Links::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('asetukset', 'asetukset/profiili');

    Volt::route('asetukset/profiili', 'settings.profile')
        ->name('settings.profile');

    Volt::route('asetukset/salasana', 'settings.password')
        ->name('settings.password');

    Volt::route('asetukset/ulkoasu', 'settings.appearance')
        ->name('settings.appearance');
});

require __DIR__.'/auth.php';
