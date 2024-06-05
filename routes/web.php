<?php

use App\Http\Controllers\Artist\ApplicationController;
use App\Http\Controllers\Artist\BookingController;
use App\Http\Controllers\Artist\PerformanceController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// ARTIST ROUTER
Route::domain('artiste.' . config('app.domain'))->name('artist.')->middleware('can:perform')->group(function () {
    Route::view('/dashboard', 'artist.dashboard')->name('dashboard');
    Route::resource('performances', PerformanceController::class)->only('index', 'edit', 'update')->parameters([
        'performances' => 'performance:slug'
    ]);
    Route::resource('applications', ApplicationController::class)->only('index', 'show', 'create', 'store');
    Route::controller(BookingController::class)->group(function () {
        Route::get('/booking', 'index')->name('booking.index');
        Route::get('/booking/{event:slug}', 'show')->name('booking.show');
    });
    Route::view('/directory', 'artist.directory', [
        'users' => User::with('profile', 'roles')->where('privacy', '=', 'public')->orWhere('privacy', '=', 'directory_only')->get(),
    ])->name('directory');
});

require __DIR__ . '/admin.php';

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
    Route::view('/', 'public.home')->name('home');
    Route::view('/agenda', 'public.agenda')->name('agenda');
    Route::view('/agenda/{event:slug}', 'public.agenda-show')->name('agenda.show');
    Route::view('/about', 'public.about')->name('about');
    Route::view('/about/team', 'public.team')->name('about.team');
    Route::view('/about/artists', 'public.artists-index')->name('about.artists');
    Route::view('/about/artists/{user:username}', 'public.artists-show')->name('artist.show');
    Route::view('/about/legal', 'public.legal')->name('about.legal');
    Route::view('/contact', 'public.contact')->name('contact');
});


require __DIR__ . '/auth.php';

