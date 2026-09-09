<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatPangkatController;
use App\Http\Controllers\RiwayatPendidikanController;
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

Route::get('pegawai/{pegawai}/riwayat-pendidikan', [RiwayatPendidikanController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('pegawai.riwayat-pendidikan.index');

Route::get('pegawai/{pegawai}/riwayat-pendidikan/create', [RiwayatPendidikanController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('pegawai.riwayat-pendidikan.create');

Route::post('pegawai/{pegawai}/riwayat-pendidikan', [RiwayatPendidikanController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('pegawai.riwayat-pendidikan.store');

Route::get('pegawai/{pegawai}/riwayat-pendidikan/{riwayatPendidikan}/edit', [RiwayatPendidikanController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('pegawai.riwayat-pendidikan.edit');

Route::put('pegawai/{pegawai}/riwayat-pendidikan/{riwayatPendidikan}', [RiwayatPendidikanController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('pegawai.riwayat-pendidikan.update');

Route::delete('pegawai/{pegawai}/riwayat-pendidikan/{riwayatPendidikan}', [RiwayatPendidikanController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('pegawai.riwayat-pendidikan.destroy');

// Route::get('pegawai/{pegawai}/riwayat-pangkat', [RiwayatPangkatController::class, 'index'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pangkat.index');

// Route::get('pegawai/{pegawai}/riwayat-pangkat/create',[RiwayatPangkatController::class, 'create'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pangkat.create');

// Route::post('pegawai/{pegawai}/riwayat-pangkat', [RiwayatPangkatController::class, 'store'])
//     ->name('pegawai.riwayat-pangkat.store')
//     ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/riwayat-pangkat/{riwayatPangkat}/edit', [RiwayatPangkatController::class, 'edit'])
//     ->name('pegawai.riwayat-pangkat.edit')
//     ->middleware(['auth', 'admin']);

// Route::put('pegawai/{pegawai}/riwayat-pangkat/{riwayatPangkat}', [RiwayatPangkatController::class, 'update'])
//     ->name('pegawai.riwayat-pangkat.update')
//     ->middleware(['auth', 'admin']);

Route::resource('pegawai.riwayat-pangkat', RiwayatPangkatController::class)
    ->middleware(['auth', 'admin'])
    ->except(['show']);