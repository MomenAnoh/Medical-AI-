<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_text',
        'patient_id',
        'doctor_id',
        'status',

    ];
    public function Answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Response::class);
    }
}
