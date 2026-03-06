<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuBiru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // TAMBAHKAN INI AGAR LARAVEL TAHU INI ADALAH TANGGAL (CARBON OBJECT)
    protected $casts = [
        'tte_approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}