<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySession extends Model
{
    use HasFactory;

    // Mengizinkan mass-assignment untuk semua kolom kecuali ID
    protected $guarded = ['id'];

    // Mendaftarkan relasi: Setiap Sesi Belajar dimiliki oleh satu User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}