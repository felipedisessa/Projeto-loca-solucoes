<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReserveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Additional Routes
    Route::get('/reserves/json', [ReserveController::class, 'getReservesJson'])->name('reserves.json');
    Route::resource('relatorios', ReportController::class)->names('reports')->parameter('relatorios', 'report');
    Route::resource('salas', RentalItemController::class)->names('rental-items')->parameter('salas', 'rentalItem');
    Route::resource('usuarios', ProfileController::class)->names('users')->parameter('usuarios', 'user');
    Route::resource('reserves', ReserveController::class);
});

require __DIR__ . '/auth.php';
