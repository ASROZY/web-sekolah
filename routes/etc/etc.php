<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Route::get('/guru', [GuruController::class, 'guru']);
    // Route::post('/guru/tambah', [GuruController::class, 'guruTambah']);
    // Route::post('/guru/{guru}/edit', [GuruController::class, 'guruEdit']);
    // Route::post('/guru/{guru}/save', [GuruController::class, 'guruSave']);
    // Route::post('/guru/{guru}/update', [GuruController::class, 'guruUpdate']);
    // Route::post('/guru/{guru}/delete', [GuruController::class, 'guruDelete']);

    // Route::get('/mapel', [MapelController::class, 'mapel']);
    // Route::get('/mapel/{mapel}/edit', [MapelController::class, 'mapelEdit']);
    // Route::get('/mapel/{mapel}/tambah', [MapelController::class, 'mapelTambah']);
    // Route::get('/mapel/{mapel}/save', [MapelController::class, 'mapelSave']);
    // Route::get('/mapel/{mapel}/update', [MapelController::class, 'mapelUpdate']);
    // Route::get('/mapel/{mapel}/delete', [MapelController::class, 'mapelDelete']);

    // Route::get('/absen', [AbsenController::class, 'absen']);
    // Route::get('/absen/{absen}/edit', [AbsenController::class, 'absenEdit']);
    // Route::get('/absen/{absen}/tambah', [AbsenController::class, 'absenTambah']);
    // Route::get('/absen/{absen}/save', [AbsenController::class, 'absenSave']);
    // Route::get('/absen/{absen}/update', [AbsenController::class, 'absenUpdate']);
    // Route::get('/absen/{absen}/delete', [AbsenController::class, 'absenDelete']);
});
