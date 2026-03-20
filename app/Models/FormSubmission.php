<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['answers' => 'array'];

    // Relasi balik ke tabel DynamicForm
    public function dynamicForm()
    {
        return $this->belongsTo(DynamicForm::class);
    }
}