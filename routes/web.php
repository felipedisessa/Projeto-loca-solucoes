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

//Route::post('/validate-reserve-field', [VisitorController::class, 'validateFields'])->name('validate-reserve-field');
Route::get('dev-Login', LoginController::class)->name('dev-login');
Route::post('/visitorCalendar/store', [VisitorController::class, 'store'])->name('visitorCalendar.store');
Route::get('/agenda', [VisitorController::class, 'showVisitorCalendar'])->name('visitorCalendar');
Route::get('/visitorCalendar/json', [VisitorController::class, 'getVisitorReservesJson'])->name('visitorCalendar.json');

//Route::get('/welcome', function() {
//    return view('welcome');
//})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Additional Routes
    Route::match(
        ['get', 'put'],
        '/reserves/json',
        [ReserveController::class, 'getReservesJson']
    )->name('reserves.json');
    Route::resource('relatorios', ReportController::class)->names('reports')->parameter('relatorios', 'report');
    Route::resource('salas', RentalItemController::class)->names('rental-items')->parameter('salas', 'rentalItem');
    Route::resource('usuarios', ProfileController::class)->names('users')->parameter('usuarios', 'user');
    Route::resource('reserves', ReserveController::class);
    Route::put('/reserves/{id}/update-date', [ReserveController::class, 'updateDate'])->name('reserves.update-date');
});

require __DIR__ . '/auth.php';
