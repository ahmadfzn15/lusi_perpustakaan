<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\DendaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::resource('/petugas', PetugasController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
    Route::resource('/buku', BukuController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/koleksi', KoleksiController::class);

    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('/peminjaman', 'index');
        Route::post('/peminjaman', 'store');
        Route::post('/pinjam/{id}/confirm', 'konfirmasiPeminjaman');
        Route::post('/pinjam/{id}/return-confirm', 'konfirmasiPengembalian');
        Route::get('/pinjam/{id}', 'pinjam');
        Route::delete('/peminjaman/{id}', 'destroy');
        Route::post('/pinjam/{id}/return', 'kembalikan');
    });

    Route::controller(UlasanController::class)->group(function () {
        Route::get('/ulasan', 'index');
        Route::get('/ulasan/{id}', 'tambah');
        Route::post('/ulasan', 'store');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('/profil', 'profil');
        Route::put('/profil', 'profilUpdate');
    });

    Route::controller(DendaController::class)->group(function () {
        Route::get('/denda', 'index');
        Route::get('/denda/{id}', 'tambah');
        Route::post('/denda/{id}/bayar', 'bayar');
        Route::post('/denda', 'store');
    });

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('/logout', 'destroy');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'create')->name('register');
        Route::post('/register', 'store');
    });
});
