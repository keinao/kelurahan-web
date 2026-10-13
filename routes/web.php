<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/informasi', [NewsController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{slug}', [NewsController::class, 'show'])->name('informasi.show');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/fasilitas', [PageController::class, 'fasilitas'])->name('fasilitas');
Route::get('/anggota-kkt', [PageController::class, 'anggotaKkt'])->name('anggota-kkt');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

Route::redirect('/statistik', '/tentang#statistik', 301);
Route::redirect('/profil', '/tentang', 301);
Route::redirect('/pemerintahan', '/tentang#struktur-pemerintahan', 301);
Route::redirect('/potensi', '/', 301);
Route::redirect('/potensi/{slug}', '/', 301);

if (app()->environment('local')) {
    Route::view('/gaya', 'pages.gaya')->name('gaya');
}