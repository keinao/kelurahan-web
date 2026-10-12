<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PotentialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/pemerintahan', [PageController::class, 'pemerintahan'])->name('pemerintahan');

Route::get('/informasi', [NewsController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{slug}', [NewsController::class, 'show'])->name('informasi.show');

Route::get('/potensi', [PotentialController::class, 'index'])->name('potensi.index');
Route::get('/potensi/{slug}', [PotentialController::class, 'show'])->name('potensi.show');

Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/fasilitas', [PageController::class, 'fasilitas'])->name('fasilitas');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
if (app()->environment('local')) {
    Route::view('/gaya', 'pages.gaya')->name('gaya');
}
