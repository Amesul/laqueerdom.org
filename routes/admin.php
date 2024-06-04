<?php

use App\Http\Controllers\Admin\AdminPerformanceController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ShowController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use Illuminate\Support\Facades\Route;

// ADMIN ROUTER
Route::domain('admin.' . config('app.domain'))->middleware('auth')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard')->middleware(['can:edit', 'can:administrate']);

    // STAFF
    Route::middleware(['can:edit', 'can:administrate'])->group(function () {
        // EVENTS
        Route::resource('events', EventController::class)->only('index', 'edit', 'update')->parameters([
            'events' => 'event:slug'
        ]);

        // VENUES
        Route::resource('venues', VenueController::class)->only('index', 'edit', 'update');

        // DOCUMENTS
        Route::resource('documents', DocumentController::class)->parameters([
            'documents' => 'document:slug'
        ]);
        Route::resource('comments', CommentController::class)->only('store', 'destroy');
    });


    // ADMIN
    Route::middleware('can:administrate')->group(function () {
        // EVENTS
        Route::resource('events', EventController::class)->only('create', 'store', 'destroy')->parameters([
            "events" => "event:slug"
        ]);

        // VENUES
        Route::resource('venues', VenueController::class)->only('create', 'store', 'destroy');

        // SHOWS
        Route::get('/show', [ShowController::class, 'index'])->name('show.index');
        Route::get('/show/{show}/edit', [ShowController::class, 'edit'])->name('show.edit');

        Route::get('/show/{show}/performances', [ShowController::class, 'editPerformances'])->name('show.edit-performances');
        Route::get('/show/{show}/performances/{performance}', [ShowController::class, 'showPerformance'])->name('show.show-performance');
        Route::get('/show/{show}/applications', [ShowController::class, 'editApplications'])->name('show.edit-applications');

        Route::patch('/show/{show}', [ShowController::class, 'update'])->name('show.update');
        Route::patch('/show/{show}/toggle-applications', [ShowController::class, 'toggleApplications'])->name('show.toggle-applications');
        Route::patch('/show/{show}/performances', [ShowController::class, 'updatePerformances'])->name('show.update-performances');
        Route::patch('/applications/{application}', [ShowController::class, 'updateApplication'])->name('show.update-application');

        Route::post('/performances/create', [AdminPerformanceController::class, 'store'])->name('performances.store');
        Route::delete('/performances/{id}/delete', [AdminPerformanceController::class, 'destroy'])->name('performances.destroy');
        Route::patch('/performances/{id}/restore', [AdminPerformanceController::class, 'restore'])->name('performances.restore');

        // USERS
        Route::resource('users', UserController::class)->only(['index', 'update', 'destroy'])->parameters([
            "users" => "user:username"
        ]);
    });
});
