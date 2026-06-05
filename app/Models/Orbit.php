<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orbit extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_surat',
        'nomor_surat',
        'tanggal_surat',
        'pengirim',
        'penerima',
        'perihal',
        'file_surat',
        'keterangan',
    ];
}