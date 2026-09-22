<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenPegawaiController;
use App\Http\Controllers\LaporanController;
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
    ->middleware('auth', 'status.pegawai')
    ->name('dashboard');

Route::get('/admin-test', function () {
    return 'Halaman khusus Admin Kepegawaian';
})->middleware(['auth', 'status.pegawai', 'admin']);

Route::resource('unit-kerja', UnitKerjaController::class)
    ->middleware(['auth', 'status.pegawai', 'admin']);;

Route::resource('jabatan', JabatanController::class)
    ->middleware(['auth', 'status.pegawai', 'admin']);

Route::resource('user', UserController::class)
    ->middleware(['auth', 'status.pegawai', 'admin']);

Route::resource('pegawai', PegawaiController::class)
    ->middleware(['auth', 'status.pegawai']);

Route::resource('pegawai.riwayat-pendidikan', RiwayatPendidikanController::class)
    ->middleware(['auth', 'status.pegawai']);

Route::resource('pegawai.riwayat-pangkat', RiwayatPangkatController::class)
    ->middleware(['auth', 'status.pegawai'])
    ->except(['show']);

Route::resource('pegawai.riwayat-jabatan', RiwayatJabatanController::class)
    ->middleware(['auth', 'status.pegawai']);

Route::resource('pegawai.dokumen', DokumenPegawaiController::class)
    ->parameters(['dokumen' => 'dokumen',])
    ->middleware(['auth', 'status.pegawai'])
    ->except(['show']);

Route::get('pegawai/{pegawai}/dokumen/{dokumen}/download', [DokumenPegawaiController::class, 'download'])
    ->name('pegawai.dokumen.download')
    ->middleware(['auth', 'status.pegawai']);

Route::get('/laporan/pegawai', [LaporanController::class, 'pegawai'])
    ->middleware(['auth', 'status.pegawai', 'admin.pimpinan'])
    ->name('laporan.pegawai');

Route::get('/laporan/pegawai/cetak', [LaporanController::class, 'cetak'])
    ->middleware(['auth', 'status.pegawai', 'admin.pimpinan'])
    ->name('laporan.pegawai.cetak');

Route::get('/laporan/pegawai/export', [LaporanController::class, 'export'])
    ->middleware(['auth', 'status.pegawai', 'admin.pimpinan'])
    ->name('laporan.pegawai.export');

Route::get('/audit-log', [AuditLogController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('audit-log.index');

// Dokumen Pegawai di Sidebar
// Route::get('/dokumen-pegawai', [DokumenPegawaiController::class, 'all'])
//     ->name('dokumen-pegawai.all')
//     ->middleware(['auth']);