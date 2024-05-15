<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\Artist\EventUserController;
use App\Http\Controllers\Artist\PerformanceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// ARTIST ROUTER
Route::domain('artiste.' . config('app.domain'))->name('artist.')->middleware('auth')->group(function () {
    Route::middleware('can:perform')->group(function () {
        Route::view('/dashboard', 'artist.dashboard')->name('dashboard');
        Route::view('/directory', 'artist.directory', ['users' => User::all()]);
        Route::resource('performances', PerformanceController::class);
        Route::resource('events', EventUserController::class);
    });
});

// ADMIN ROUTER
Route::domain('admin.' . config('app.domain'))->middleware('auth')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard')->middleware(['can:edit', 'can:administrate']);

    Route::middleware(['can:edit', 'can:administrate'])->group(function () {
        Route::resource('events', EventController::class)->only('index', 'edit', 'update');
        Route::resource('venues', VenueController::class)->only('index', 'edit', 'update');
        Route::resource('documents', DocumentController::class);
        Route::resource('users', UserController::class)->only('index');
    });

    Route::middleware('can:administrate')->group(function () {
        Route::resource('events', EventController::class)->except('index', 'edit', 'update');
        Route::resource('venues', VenueController::class)->except('index', 'edit', 'update');
        Route::resource('users', UserController::class)->only(['update', 'destroy']);
    });
});

// ACCOUNT ROUTER
Route::domain(config('app.domain'))->middleware('auth')->group(function () {
    Route::get('/profile', [SettingsController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [SettingsController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [SettingsController::class, 'destroy'])->name('profile.destroy');
});

Route::domain(config('app.domain'))->group(function () {
    Route::view('/', 'welcome');
});

require __DIR__ . '/auth.php';

