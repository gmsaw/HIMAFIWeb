<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/profilevideo', function () {
    return view('pages.profilevideo');
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