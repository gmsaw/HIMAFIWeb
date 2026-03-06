<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_name',
        'user_email',
        'document_title',
        'description',
        'file_path',
        'verification_token',
        'status',
        'signer_name',
        'signed_at'
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];
}