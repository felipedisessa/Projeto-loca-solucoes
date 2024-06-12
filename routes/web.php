<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\UserController;
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

    //endregion

    //region Rental Items
    Route::resource('rental-items', RentalItemController::class);
    Route::resource('users', UserController::class);
    //endregion
});

require __DIR__ . '/auth.php';
