<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenPegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatJabatanController;
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

Route::resource('unit-kerja', UnitKerjaController::class)
    ->middleware(['auth', 'admin']);;

Route::resource('jabatan', JabatanController::class)
    ->middleware(['auth', 'admin']);

Route::resource('pegawai', PegawaiController::class)
    ->middleware(['auth', 'admin']);

Route::resource('pegawai.riwayat-pendidikan', RiwayatPendidikanController::class)
    ->middleware(['auth', 'admin']);

Route::resource('pegawai.riwayat-pangkat', RiwayatPangkatController::class)
    ->middleware(['auth', 'admin'])
    ->except(['show']);

Route::resource('pegawai.riwayat-jabatan', RiwayatJabatanController::class)
    ->middleware(['auth', 'admin']);

Route::resource('pegawai.dokumen', DokumenPegawaiController::class)
    ->parameters(['dokumen' => 'dokumen',])
    ->middleware(['auth', 'admin'])
    ->except(['show']);

Route::get('pegawai/{pegawai}/dokumen/{dokumen}/download', [DokumenPegawaiController::class, 'download'])
    ->name('pegawai.dokumen.download')
    ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/riwayat-pendidikan', [RiwayatPendidikanController::class, 'index'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pendidikan.index');

// Route::get('pegawai/{pegawai}/riwayat-pendidikan/create', [RiwayatPendidikanController::class, 'create'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pendidikan.create');

// Route::post('pegawai/{pegawai}/riwayat-pendidikan', [RiwayatPendidikanController::class, 'store'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pendidikan.store');

// Route::get('pegawai/{pegawai}/riwayat-pendidikan/{riwayatPendidikan}/edit', [RiwayatPendidikanController::class, 'edit'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pendidikan.edit');

// Route::put('pegawai/{pegawai}/riwayat-pendidikan/{riwayatPendidikan}', [RiwayatPendidikanController::class, 'update'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pendidikan.update');

// Route::delete('pegawai/{pegawai}/riwayat-pendidikan/{riwayatPendidikan}', [RiwayatPendidikanController::class, 'destroy'])
//     ->middleware(['auth', 'admin'])
//     ->name('pegawai.riwayat-pendidikan.destroy');



// Route::get('pegawai/{pegawai}/riwayat-jabatan', [RiwayatJabatanController::class, 'index'])
//     ->name('pegawai.riwayat-jabatan.index')
//     ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/riwayat-jabatan/create', [RiwayatJabatanController::class, 'create'])
//     ->name('pegawai.riwayat-jabatan.create')
//     ->middleware(['auth', 'admin']);

// Route::post('pegawai/{pegawai}/riwayat-jabatan', [RiwayatJabatanController::class, 'store'])
//     ->name('pegawai.riwayat-jabatan.store')
//     ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/riwayat-jabatan/{riwayatJabatan}/edit', [RiwayatJabatanController::class, 'edit'])
//     ->name('pegawai.riwayat-jabatan.edit')
//     ->middleware(['auth', 'admin']);

// Route::put('pegawai/{pegawai}/riwayat-jabatan/{riwayatJabatan}', [RiwayatJabatanController::class, 'update'])
//     ->name('pegawai.riwayat-jabatan.update')
//     ->middleware(['auth', 'admin']);

// Route::delete('pegawai/{pegawai}/riwayat-jabatan/{riwayatJabatan}', [RiwayatJabatanController::class, 'destroy'])
//     ->name('pegawai.riwayat-jabatan.destroy')
//     ->middleware(['auth', 'admin']);



// Route::middleware(['auth', 'admin'])->group(function () {
//     // 1. Rute Kustom (Download)
//     Route::get('pegawai/{pegawai}/dokumen/{dokumen}/download', [DokumenPegawaiController::class, 'download'])
//         ->name('pegawai.dokumen.download');

//     // 2. Resource Routes (index, create, store, edit, update, destroy)
//     Route::resource('pegawai.dokumen', DokumenPegawaiController::class);
// });


// Route::get('pegawai/{pegawai}/dokumen', [DokumenPegawaiController::class, 'index'])
//     ->name('pegawai.dokumen.index')
//     ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/dokumen/create', [DokumenPegawaiController::class, 'create'])
//     ->name('pegawai.dokumen.create')
//     ->middleware(['auth', 'admin']);

// Route::post('pegawai/{pegawai}/dokumen', [DokumenPegawaiController::class, 'store'])
//     ->name('pegawai.dokumen.store')
//     ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/dokumen/{dokumen}/download', [DokumenPegawaiController::class, 'download'])
//     ->name('pegawai.dokumen.download')
//     ->middleware(['auth', 'admin']);

// Route::get('pegawai/{pegawai}/dokumen/{dokumen}/edit', [DokumenPegawaiController::class, 'edit'])
//     ->name('pegawai.dokumen.edit')
//     ->middleware(['auth', 'admin']);

// Route::put('pegawai/{pegawai}/dokumen/{dokumen}', [DokumenPegawaiController::class, 'update'])
//     ->name('pegawai.dokumen.update')
//     ->middleware(['auth', 'admin']);

// Route::delete('pegawai/{pegawai}/dokumen/{dokumen}', [DokumenPegawaiController::class, 'destroy'])
//     ->name('pegawai.dokumen.destroy')
//     ->middleware(['auth', 'admin']);