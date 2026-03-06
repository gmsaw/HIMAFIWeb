<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    // Cast date agar mudah diformat
    protected $casts = [
        'date' => 'date',
    ];
}