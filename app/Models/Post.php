<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke User (Penulis)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}