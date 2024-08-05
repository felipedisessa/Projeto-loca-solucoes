<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('login');
});
// routes/web.php
Route::get('/check-user-exists/{email}', [VisitorController::class, 'checkIfUserExists'])->name('check-user-exist');
Route::get('dev-Login', LoginController::class)->name('dev-login');
Route::post('/visitorCalendar/store', [VisitorController::class, 'store'])->name('visitorCalendar.store');
Route::get('/agenda', [VisitorController::class, 'showVisitorCalendar'])->name('visitorCalendar');
Route::get('/visitorCalendar/json', [VisitorController::class, 'getVisitorReservesJson'])->name('visitorCalendar.json');

Route::middleware('auth')->group(function() {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/image', [ProfileController::class, 'updateProfileImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/calendario', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete(
        '/profile/delete-image',
        [ProfileController::class, 'deleteProfileImage']
    )->name('profile.deleteImage');

    // Additional Routes
    Route::match(
        ['get', 'put'],
        '/reserves/json',
        [ReserveController::class, 'getReservesJson']
    )->name('reserves.json');
    Route::resource('relatorios', ReportController::class)->names('reports')->parameter('relatorios', 'report');
    Route::delete(
        '/rental-items/{id}/delete-image',
        [RentalItemController::class, 'destroyImage']
    )->name('rental-items.deleteImage');
    Route::resource('salas', RentalItemController::class)->names('rental-items')->parameter('salas', 'rentalItem');
    Route::resource('usuarios', ProfileController::class)->names('users')->parameter('usuarios', 'user');
    Route::resource('reservas', ReserveController::class)->names('reserves')->parameter('reservas', 'reserve');
    Route::put('/reserves/{id}/update-date', [ReserveController::class, 'updateDate'])->name('reserves.update-date');
});

require __DIR__ . '/auth.php';
