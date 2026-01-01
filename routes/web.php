<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\FungsionarisController;

// PUBLIC
// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('pages.login');
});

// Video Profile
Route::get('/video-profile', [VideoController::class, 'index'])->name('profile.video');

Route::get('/fungsionaris', [FungsionarisController::class, 'index'])->name('fungsionaris');

Route::get('/artikel', function () {
    return view('pages.artikel');
});

Route::get('/artikel/view', [ArtikelController::class, 'index'])->name('Artikel Himafi');

Route::get('/perpustakaan', function () {
    return view('pages.perpus');
});

Route::get('/aspirasi', function () {
    return view('pages.formaspirasi');
});

Route::get('/pengajuantte', function () {
    return view('pages.pengajuantte');
});

Route::get('/verifikasi', function () {
    return view('pages.verifikasitte');
});

Route::get('/katalog', function () {
    return view('pages.koprasikatalog');
});

// ADMIN