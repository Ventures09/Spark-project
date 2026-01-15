<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserDashboard\MainController;
use App\Http\Controllers\Logs\LogsController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Students\StudentsDitController;
use App\Http\Controllers\Events\EventsController;

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
Route::get('/dashboard', [MainController::class, 'index'])
    ->name('dashboard.main');

// Logs page
Route::get('/logs', [LogsController::class, 'index'])
    ->name('logs.logspage');

// Students page
Route::get('/students', [StudentsController::class, 'index'])
    ->name('students.studentspage');

Route::get('/students/dit', [StudentsDitController::class, 'index'])->name('students.studentspagedit');

// Events page
Route::get('/events', [EventsController::class, 'index'])
    ->name('events.eventspage');

/* ===== LOGOUT ===== */
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
