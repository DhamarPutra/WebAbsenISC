<?php

use App\Http\Controllers\Api\AbsenController;
use App\Http\Controllers\Api\AcaraController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BidangController;
use App\Http\Controllers\Api\KegiatanController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\ModulController;
use App\Http\Controllers\Api\NfcCardController;
use App\Http\Controllers\Api\SuratController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Done
    Route::post('/absen', [AbsenController::class, 'addAbsen']);
    Route::get('/absen', [AbsenController::class, 'getAbsen']);
    Route::get('/absen/cek', [AbsenController::class, 'showPresensiSaya']);
    Route::post('/absen/mark-absent', [AbsenController::class, 'markRemainingAbsent']);
    Route::post('/acara/store', [AcaraController::class, 'store']);
    Route::get('/bidang', [BidangController::class, 'index']);
    Route::delete('/mahasiswa/delete/{id_isc}', [MahasiswaController::class, 'destroy']);
    Route::put('/mahasiswa/update/{id_isc}', [MahasiswaController::class, 'update']);
    Route::post('/nfc/check', [NfcCardController::class, 'check']);
    Route::post('/nfc/store', [NfcCardController::class, 'store']);
    Route::post('/nfc/login', [NfcCardController::class, 'login']);

    // Belom
    Route::post('/password/change-request', [AuthController::class, 'requestPasswordChange']);
    Route::get('/admin/password-requests', [AuthController::class, 'listPasswordRequests']);
    Route::post('/admin/password-approve/{id}', [AuthController::class, 'approvePasswordChange']);
    Route::post('/admin/password-reject/{id}', [AuthController::class, 'rejectPasswordChange']);
    Route::get('/absen/count-absent', [AbsenController::class, 'countAbsent']);
    Route::get('/bidang/koor', [BidangController::class, 'indexKoor']);
    Route::post('/kegiatan/store', [KegiatanController::class, 'store']);

    Route::get('/modul', [ModulController::class, 'index']);
    Route::delete('/modul/{id}', [ModulController::class, 'destroy']);
    Route::get('/modul/create', [ModulController::class, 'create']);
    Route::post('/modul/store', [ModulController::class, 'store']);
    Route::get('/jenis-surat/create', [SuratController::class, 'createJenisSurat']);
    Route::post('/jenis-surat', [SuratController::class, 'storeJenisSurat']);
    Route::get('/nomor-surat/create', [SuratController::class, 'createNomorSurat']);
    Route::post('/nomor-surat', [SuratController::class, 'storeNomorSurat']);
    Route::get('/nomor-surat', [SuratController::class, 'indexNomorSurat']);
    Route::get('/nomor-surat/{id}', [SuratController::class, 'showNomorSurat']);
});
