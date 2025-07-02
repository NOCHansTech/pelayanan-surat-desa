<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratPengajuanController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResidentController;
use App\Models\SuratPengajuan;

Route::middleware(['guest:web'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/prosesregister', [AuthController::class, 'prosesregister'])->name('prosesregister');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/proseslogout', [AuthController::class, 'proseslogout'])->name('proseslogout');

    // Jenis Surat
    Route::get('/jenis-surat', [JenisSuratController::class, 'index'])->name('jenis-surat');
    Route::post('/jenis-surat/store', [JenisSuratController::class, 'store'])->name('jenis-surat.store');
    Route::post('/jenis-surat/{id}/update', [JenisSuratController::class, 'update'])->name('jenis-surat.update');
    Route::post('/jenis-surat/{id}/delete', [JenisSuratController::class, 'delete'])->name('jenis-surat.delete');

    // Surat Pengajuan
    Route::get('/surat-pengajuan', [SuratPengajuanController::class, 'index'])->name('surat-pengajuan');
    Route::get('/surat-pengajuan/create', [SuratPengajuanController::class, 'create'])->name('surat-pengajuan.create');
    Route::post('/surat-pengajuan/store', [SuratPengajuanController::class, 'store'])->name('surat-pengajuan.store');
    Route::get('/get-resident-data/{id}', [SuratPengajuanController::class, 'getResidentData'])->name('get-resident-data');
    // Route::get('/get-nomor-surat/{id}', [SuratPengajuanController::class, 'getNomorSurat'])->name('get-nomor');
    Route::get('/surat-pengajuan/{id}/detail', [SuratPengajuanController::class, 'detail'])->name('surat-pengajuan.detail');
    Route::post('/surat-pengajuan/status/{id}', [SuratPengajuanController::class, 'updateStatus'])->name('surat-pengajuan.update_status');
    Route::delete('/surat-pengajuan/{id}', [SuratPengajuanController::class, 'destroy'])->name('surat-pengajuan.destroy');
    Route::get('/surat-pengajuan/cetak/sktm/{id}', [SuratPengajuanController::class, 'cetakSKTM'])->name('surat-pengajuan.cetaksktm');
    Route::get('/surat-pengajuan/cetak/sku/{id}', [SuratPengajuanController::class, 'cetakSKU'])->name('surat-pengajuan.cetaksku');
    Route::get('/surat-pengajuan/cetak/domisili/{id}', [SuratPengajuanController::class, 'cetakDomisili'])->name('surat-pengajuan.cetakdomisili');
    Route::get('/surat-pengajuan/cetak/domisililembaga/{id}', [SuratPengajuanController::class, 'cetakDomisiliLembaga'])->name('surat-pengajuan.cetakdomisililembaga');
    Route::get('/surat-pengajuan/cetak-umum/{id}', [SuratPengajuanController::class, 'cetakUmum'])->name('surat-pengajuan.cetakumum');

    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/profile', [UsersController::class, 'profile'])->name('users.profile');
    Route::post('/users/profile', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::get('/resident', [ResidentController::class, 'index'])->name('users.resident');
});
