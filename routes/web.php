<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/admin-test', function () {
    return 'Halaman khusus Admin Kepegawaian';
})->middleware(['auth', 'admin']);

Route::resource('unit-kerja', UnitKerjaController::class)->middleware(['auth', 'admin']);;

Route::resource('jabatan', JabatanController::class)->middleware(['auth', 'admin']);

Route::resource('pegawai', PegawaiController::class)
    ->middleware(['auth', 'admin']);