<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\PengumpulanTugasController;

// ==================== ABSEN ====================
Route::get('/', [PortalController::class, 'formAbsen'])->name('form.absen');
Route::post('/absen', [PortalController::class, 'simpanAbsen'])->name('simpan.absen');
Route::get('/tampil-absen', [PortalController::class, 'tampilAbsen'])->name('tampil.absen');
Route::delete('/hapus-absen/{id}', [PortalController::class, 'hapusAbsen'])->name('hapus.absen');

// ==================== TUGAS ====================
Route::get('/tugas', [PortalController::class, 'formTugas'])->name('form.tugas');
Route::post('/tugas', [PortalController::class, 'simpanTugas'])->name('simpan.tugas');
Route::get('/tampil-tugas', [PortalController::class, 'tampilTugas'])->name('tampil.tugas');
Route::delete('/hapus-tugas/{id}', [PortalController::class, 'hapusTugas'])->name('hapus.tugas');

// ==================== EDIT & UPDATE TUGAS ====================
Route::get('/edit-tugas/{id}', [PortalController::class, 'editTugas'])->name('edit.tugas');
Route::put('/update-tugas/{id}', [PortalController::class, 'updateTugas'])->name('update.tugas');

// ==================== LIHAT PDF ====================
Route::get('/lihat-tugas/{id}', [PengumpulanTugasController::class, 'viewPdf'])->name('lihat.tugas');