<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenPegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\RiwayatPangkatController;
use App\Http\Controllers\RiwayatPendidikanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
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

Route::resource('unit-kerja', UnitKerjaController::class)
    ->middleware(['auth', 'admin']);;

Route::resource('jabatan', JabatanController::class)
    ->middleware(['auth', 'admin']);

Route::resource('user', UserController::class)
    ->middleware(['auth', 'admin']);

Route::resource('pegawai', PegawaiController::class)
    ->middleware(['auth']);

Route::resource('pegawai.riwayat-pendidikan', RiwayatPendidikanController::class)
    ->middleware(['auth']);

Route::resource('pegawai.riwayat-pangkat', RiwayatPangkatController::class)
    ->middleware(['auth',])
    ->except(['show']);

Route::resource('pegawai.riwayat-jabatan', RiwayatJabatanController::class)
    ->middleware(['auth']);

Route::resource('pegawai.dokumen', DokumenPegawaiController::class)
    ->parameters(['dokumen' => 'dokumen',])
    ->middleware(['auth'])
    ->except(['show']);

Route::get('pegawai/{pegawai}/dokumen/{dokumen}/download', [DokumenPegawaiController::class, 'download'])
    ->name('pegawai.dokumen.download')
    ->middleware(['auth']);