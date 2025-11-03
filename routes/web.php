<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TimAuditController;
use App\Http\Controllers\JadwalAuditController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\TindakLanjutController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes (guest only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Logout route (can be accessed by authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (auth required)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User management routes (admin only)
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    
    // Pegawai management routes (admin only)
    Route::resource('pegawai', PegawaiController::class)->names([
        'index' => 'pegawai.index',
        'create' => 'pegawai.create',
        'store' => 'pegawai.store',
        'edit' => 'pegawai.edit',
        'update' => 'pegawai.update',
        'destroy' => 'pegawai.destroy',
    ]);
    
    // Tim Audit management routes (admin only)
    Route::resource('tim_audit', TimAuditController::class)->names([
        'index' => 'tim_audit.index',
        'create' => 'tim_audit.create',
        'store' => 'tim_audit.store',
        'show' => 'tim_audit.show',
        'edit' => 'tim_audit.edit',
        'update' => 'tim_audit.update',
        'destroy' => 'tim_audit.destroy',
    ]);
    
    // Jadwal Audit management routes (admin only)
    Route::resource('jadwal_audit', JadwalAuditController::class)->names([
        'index' => 'jadwal_audit.index',
        'create' => 'jadwal_audit.create',
        'store' => 'jadwal_audit.store',
        'show' => 'jadwal_audit.show',
        'edit' => 'jadwal_audit.edit',
        'update' => 'jadwal_audit.update',
        'destroy' => 'jadwal_audit.destroy',
    ]);
    
    // Pemeriksaan management routes (admin only)
    Route::resource('pemeriksaan', PemeriksaanController::class)->names([
        'index' => 'pemeriksaan.index',
        'create' => 'pemeriksaan.create',
        'store' => 'pemeriksaan.store',
        'show' => 'pemeriksaan.show',
        'edit' => 'pemeriksaan.edit',
        'update' => 'pemeriksaan.update',
        'destroy' => 'pemeriksaan.destroy',
    ]);
    
    // Tindak Lanjut management routes (admin only)
    Route::resource('tindak_lanjut', TindakLanjutController::class)->names([
        'index' => 'tindak_lanjut.index',
        'create' => 'tindak_lanjut.create',
        'store' => 'tindak_lanjut.store',
        'show' => 'tindak_lanjut.show',
        'edit' => 'tindak_lanjut.edit',
        'update' => 'tindak_lanjut.update',
        'destroy' => 'tindak_lanjut.destroy',
    ]);
    
    // Laporan routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/tim-audit/pdf', [LaporanController::class, 'timAuditPdf'])->name('laporan.tim-audit.pdf');
    Route::match(['get', 'post'], '/laporan/jadwal-audit/pdf', [LaporanController::class, 'jadwalAuditPdf'])->name('laporan.jadwal-audit.pdf');
    Route::match(['get', 'post'], '/laporan/pemeriksaan/pdf', [LaporanController::class, 'pemeriksaanPdf'])->name('laporan.pemeriksaan.pdf');
    Route::match(['get', 'post'], '/laporan/tindak-lanjut/pdf', [LaporanController::class, 'tindakLanjutPdf'])->name('laporan.tindak-lanjut.pdf');
});
