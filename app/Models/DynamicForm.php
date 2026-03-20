<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicForm extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['fields' => 'array', 'answers' => 'array'];

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }
}
