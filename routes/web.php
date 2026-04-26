<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LangController;

// Auth
Route::get('/login',    [LoginController::class,    'showForm'])->name('login');
Route::post('/login',   [LoginController::class,    'login']);
Route::post('/logout',  [LoginController::class,    'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register',[RegisterController::class, 'register']);

// Langue
Route::get('/lang/{locale}', [LangController::class, 'switch'])->name('lang.switch');

// App (auth requise)
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('appointments.index'));
    Route::resource('appointments', AppointmentController::class);
    Route::resource('services', ServiceController::class);
});