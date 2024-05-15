<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\Artist\EventUserController;
use App\Http\Controllers\Artist\PerformanceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShowController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// ARTIST ROUTER
Route::domain('artiste.' . config('app.domain'))->name('artist.')->middleware('auth')->group(function () {
    Route::middleware('can:perform')->group(function () {
        Route::view('/dashboard', 'artist.dashboard')->name('dashboard');
        Route::view('/directory', 'artist.directory', ['users' => User::all()]);
        Route::resource('performances', PerformanceController::class);
        Route::resource('events', EventUserController::class)->only('index', 'show');
        Route::view('/directory', 'artist.directory', ['users' => User::all()])->name('directory');
    });
});

// ADMIN ROUTER
Route::domain('admin.' . config('app.domain'))->middleware('auth')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard')->middleware(['can:edit', 'can:administrate']);

    Route::middleware(['can:edit', 'can:administrate'])->group(function () {
        Route::resource('events', EventController::class)->only('index', 'edit', 'update');
        Route::resource('venues', VenueController::class)->only('index', 'edit', 'update');
        Route::resource('shows', ShowController::class)->only('index', 'edit', 'update');
        Route::resource('documents', DocumentController::class)->only('index', 'edit', 'update');
        Route::resource('users', UserController::class)->only('index');
    });

    Route::middleware('can:administrate')->group(function () {
        Route::resource('events', EventController::class)->except('show', 'index', 'edit', 'update');
        Route::resource('venues', VenueController::class)->except('show', 'index', 'edit', 'update');
        Route::resource('users', UserController::class)->only(['update', 'destroy']);
    });
});

// ACCOUNT ROUTER
Route::domain(config('app.domain'))->middleware('auth')->group(function () {
    Route::get('/profile', [SettingsController::class, 'edit'])->name('profile.edit');
    Route::patch('/user', [SettingsController::class, 'update'])->name('user.update');
    Route::patch('/profile', ProfileController::class)->name('profile.update');
    Route::patch('/privacy', PrivacyController::class)->name('privacy.update');
    Route::delete('/profile', [SettingsController::class, 'destroy'])->name('profile.destroy');
});


// PUBLIC ROUTER
Route::domain(config('app.domain'))->group(function () {
    Route::view('/', 'public.welcome')->name('home');
    Route::view('/agenda', 'public.agenda')->name('agenda');
    Route::view('/about', 'public.about')->name('about');
    Route::view('/about/team', 'public.team')->name('about.team');
    Route::view('/about/artists', 'public.artists-index')->name('about.artists');
    Route::view('/about/artists/{user:username}', 'public.artists-show')->name('artist.show');
    Route::view('/about/legal', 'public.legal')->name('legal');
    Route::view('/contact', 'public.contact')->name('contact');
});


require __DIR__ . '/auth.php';

