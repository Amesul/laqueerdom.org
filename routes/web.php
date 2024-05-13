<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\Artist\EventUserController;
use App\Http\Controllers\Artist\PerformanceController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// ARTIST ROUTER
Route::domain('artiste.' . config('app.domain'))->name('artist.')->middleware('can:perform')->group(function () {
    Route::view('/directory', 'artist.directory', ['users' => User::all()]);
    Route::resource('performances', PerformanceController::class);
    Route::resource('events', EventUserController::class);
});

// ADMIN ROUTER
Route::domain('admin.' . config('app.domain'))->name('admin.')->middleware('can:administrate')->group(function () {
    Route::resource('events', EventController::class);
    Route::resource('venues', VenueController::class);
    Route::resource('users', UserController::class)->only(['index', 'update', 'destroy']);
});

// ACCOUNT ROUTER
Route::domain('account.' . config('app.domain'))->name('.account')->middleware('auth')->group(function () {
    Route::get('/profile', [SettingsController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [SettingsController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [SettingsController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
