<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PpdbController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'authAdmin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
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
    Route::get('admin/pengurus', [AdminController::class, 'indexPengurus']);
    Route::get('admin/pengurus/tambah', [AdminController::class, 'tambahPengurus']);
    Route::post('admin/pengurus/tambah', [AdminController::class, 'storePengurus']);
    Route::get('admin/pengurus/{pengurus}/edit', [AdminController::class, 'editPengurus']);
    Route::post('admin/pengurus/{pengurus}/update', [AdminController::class, 'updatePengurus']);
    Route::post('admin/pengurus/delete', [AdminController::class, 'deletePengurus']);

    Route::get('admin/banner', [BannerController::class, 'index']);
    Route::get('admin/banner/tambah', [BannerController::class, 'tambah']);
    Route::post('admin/banner/tambah', [BannerController::class, 'store']);
    Route::get('admin/banner/{banner}/edit', [BannerController::class, 'edit']);
    Route::post('admin/banner/{banner}/update', [BannerController::class, 'update']);
    Route::post('admin/banner/delete', [BannerController::class, 'delete']);

    Route::get('admin/berita', [BeritaController::class, 'index']);
    Route::get('admin/berita/tambah', [BeritaController::class, 'tambah']);
    Route::post('admin/berita/tambah', [BeritaController::class, 'store']);
    Route::get('admin/berita/{berita}/edit', [BeritaController::class, 'edit']);
    Route::post('admin/berita/{berita}/update', [BeritaController::class, 'update']);
    Route::post('admin/berita/delete', [BeritaController::class, 'delete']);

    Route::post('admin/kategori/tambah', [BeritaController::class, 'storeKategori']);

    Route::get('ppdb/pendaftar', [PpdbController::class, 'index']);
    Route::get('ppdb/{id}/detail', [PpdbController::class, 'detailPpdb']);
});
Route::middleware(['auth', 'authPpdb'])->group(function () {
    Route::get('ppdb/data', [PpdbController::class, 'detailData']);
    Route::get('ppdb/daftar', [PpdbController::class, 'register']);
    Route::post('ppdb/register', [PpdbController::class, 'ppdbStore']);
});
