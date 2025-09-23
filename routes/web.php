<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuratController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/account', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif (Auth::user()->role == 'koor') {
            return redirect()->route('dashboard.koor');
        }
        return redirect()->route('dashboard.user');
    }
    return view('auth.account');
})->name('account');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/request-password-change', [AuthController::class, 'requestChangeShow'])->name('password.request.change.create');
Route::post('/request-password-change/store', [AuthController::class, 'requestChangeStore'])->name('password.request.change.store');

Route::middleware(['auth', RoleMiddleware::class . ':user,koor,admin'])->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'indexUser'])->name('dashboard.user');

    // Modul
    Route::get('/modul', [ModulController::class, 'index'])->name('modul.index');

    // Absen
    Route::get('/absen/cek', [AbsenController::class, 'showPresensiSaya'])->name('absen.cek');
});

Route::middleware(['auth', RoleMiddleware::class . ':koor,admin'])->group(function () {
    Route::get('/dashboard/koor', [DashboardController::class, 'indexKoor'])->name('dashboard.koor');

    // Modul
    Route::delete('/modul/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');
    Route::get('/modul/create', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/modul/store', [ModulController::class, 'store'])->name('modul.store');

    // Absen
    Route::get('/absen/scan', [AbsenController::class, 'scan'])->name('absen.scan');
    Route::get('/absen/manual', [AbsenController::class, 'manual'])->name('absen.manual');
    Route::post('/absen/mark-absent', [AbsenController::class, 'markRemainingAbsent'])->name('absen.mark');

    // Bidang
    Route::get('/bidang/koor', [BidangController::class, 'indexKoor'])->name('bidang.koor.index');
    Route::delete('/mahasiswa/{id_isc}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');

    // CMS berita acara
    Route::get('/acara/create', [AcaraController::class, 'create'])->name('acara.create');
    Route::post('/acara/store', [AcaraController::class, 'store'])->name('acara.store');

    // CMS kegiatan
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');

    // Peminatan Mahasiswa
    Route::get('/bidang', [BidangController::class, 'index'])->name('bidang.index');
    Route::get('/mahasiswa/{id_isc}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id_isc}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

    // Tool Sekertaris
    Route::get('/jenis-surat/create', [SuratController::class, 'createJenisSurat'])->name('jenis-surat.create');
    Route::post('/jenis-surat', [SuratController::class, 'storeJenisSurat'])->name('jenis-surat.store');
    Route::get('/nomor-surat/create', [SuratController::class, 'createNomorSurat'])->name('nomor-surat.create');
    Route::post('/nomor-surat', [SuratController::class, 'storeNomorSurat'])->name('nomor-surat.store');
    Route::get('/nomor-surat', [SuratController::class, 'indexNomorSurat'])->name('nomor-surat.index');
    Route::get('/nomor-surat/{id}', [SuratController::class, 'showNomorSurat'])->name('nomor-surat.show');

    // Password Confirm
    Route::get('/admin/password-requests', [AuthController::class, 'passwordChangeConfirmShow'])->name('admin.password.requests');
    Route::post('/admin/password-requests/{id}/approve', [AuthController::class, 'passwordChangeConfirmApprove'])->name('admin.password.approve');
    Route::post('/admin/password-requests/{id}/reject', [AuthController::class, 'passwordChangeConfirmReject'])->name('admin.password.reject');

    // Event
    Route::get('/event', [EventController::class, 'indexEvent'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'createEvent'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'storeEvent'])->name('event.store');
    Route::delete('/event/{id}', [EventController::class, 'destroyEvent'])->name('event.destroy');
});
