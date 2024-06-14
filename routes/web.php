<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReserveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
    //region Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reserves/json', [ReserveController::class, 'getReservesJson']);
    //endregion

    //region Rental Items
    Route::resource('rental-items', RentalItemController::class);
    Route::resource('users', ProfileController::class);
    Route::resource('reserves', ReserveController::class);
    //endregion

    // routes/web.php
});

require __DIR__ . '/auth.php';
