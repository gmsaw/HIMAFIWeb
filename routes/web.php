<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('pages.login');
});

// Video Profile
Route::get('/video-profile', [VideoController::class, 'index'])->name('profile.video');

Route::get('/fungsionaris', function () {
    return view('pages.fungsionaris');
});

Route::get('/artikel', function () {
    return view('pages.artikel');
});

Route::get('/artikel/view', function () {
    return view('pages.artikelView');
});

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