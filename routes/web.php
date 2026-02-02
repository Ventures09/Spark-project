<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserDashboard\MainController;
use App\Http\Controllers\Logs\LogsController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Students\StudentsDitController;
use App\Http\Controllers\Events\EventsController;
use App\Http\Controllers\Events\EventNameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [WelcomeController::class, 'index'])->name('home');

/* ===== LOGIN ROUTES ===== */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

/* ===== DASHBOARD ===== */
Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard.main');

// Logs page
Route::get('/logs', [LogsController::class, 'index'])->name('logs.logspage');

// Students page
Route::get('/students', [StudentsController::class, 'index'])->name('students.studentspage');
Route::get('/students/dit', [StudentsDitController::class, 'index'])->name('students.studentspagedit');

/* ===== EVENTS ===== */
Route::prefix('events')->group(function () {
    Route::get('/', [EventsController::class, 'index'])->name('events.index');
    Route::post('/', [EventsController::class, 'store'])->name('events.store');
    Route::get('/{event}', [EventsController::class, 'show'])->name('events.show');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::delete('/events/{event}', [EventNameController::class, 'destroy'])->name('events.destroy');

});

/* ===== LOGOUT ===== */
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
