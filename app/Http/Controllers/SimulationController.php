<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    // Halaman Utama Daftar Simulasi
    public function index()
    {
        return view('pages.simulasi.index', ['activePage' => 'simulasi']);
    }

    // Halaman Simulasi Spesifik: Gerak Parabola
    public function parabola()
    {
        return view('pages.simulasi.parabola', ['activePage' => 'simulasi']);
    }

    public function ohmkirchoff()
    {
        return view('pages.simulasi.ohmkirchoff', ['activePage' => 'simulasi']);
    }
}