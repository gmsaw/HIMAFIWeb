<?php

namespace App\Http\Controllers;

use App\Models\Orbit;
use Illuminate\Http\Request;

class PublicOrbitController extends Controller
{
    public function verify(Request $request)
    {
        $surat = null;
        $searched = false;

        // Jika user melakukan pencarian nomor surat
        if ($request->filled('nomor_surat')) {
            $searched = true;
            $searchQuery = trim($request->nomor_surat);
            
            // Cari surat dengan nomor yang sama persis (exact match)
            $surat = Orbit::where('nomor_surat', $searchQuery)->first();
        }

        return view('pages.orbit.verify', compact('surat', 'searched'));
    }
}