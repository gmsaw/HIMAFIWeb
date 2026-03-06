<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'category',
        'stock',
        'description',
        'cover_image',
        'file_path',
        'file_url', // <--- TAMBAHKAN INI
    ];
    
    protected $guarded = ['id'];
}
