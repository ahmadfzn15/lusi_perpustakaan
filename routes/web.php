<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\DendaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/petugas', PetugasController::class);
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(PageController::class)->group(function () {
        Route::get('/profil', 'profil')->name('profile');
    });

    Route::resource('/buku', BukuController::class);
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::resource('/koleksi', KoleksiController::class);

    Route::controller(DendaController::class)->group(function () {
        Route::get('/denda', 'index');
        Route::get('/denda/{id}', 'tambah');
        Route::post('/denda', 'store');
    });

    Route::controller(UlasanController::class)->group(function () {
        Route::get('/ulasan', 'index');
        Route::get('/ulasan/{id}', 'tambah');
        Route::post('/ulasan', 'store');
    });

    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('/pinjam/{id}', 'pinjam');
        Route::post('/pinjam/{id}/confirm', 'konfirmasiPeminjaman');
        Route::post('/pinjam/{id}/return-confirm', 'konfirmasiPengembalian');
        Route::post('/pinjam/{id}/return', 'kembalikan');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store');
        Route::post('/logout', 'destroy');
    });
});


require __DIR__.'/auth.php';
