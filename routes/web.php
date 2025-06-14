<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::view('dashboard', 'dashboard')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::middleware(['auth'])->group(function () {
            Route::redirect('settings', 'settings/profile');

            Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
            Volt::route('settings/password', 'settings.password')->name('settings.password');
            Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

            Volt::route('tenants', 'tenants.index')->name('tenants.index');
            Volt::route('tenants/create', 'tenants.create')->name('tenants.create');
            Volt::route('tenants/{tenant}/edit', 'tenants.edit')->name('tenants.edit');
        });

        require __DIR__ . '/auth.php';
    });
}
