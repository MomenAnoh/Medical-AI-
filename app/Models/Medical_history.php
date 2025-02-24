<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_history extends Model
{
    use HasFactory;
    protected $fillable = ['Name_of_Surgery', 'Description_of_Surgery', 'user_id'];

    public function patient()
    {
        return $this->belongsTo(User::class);
    }
}
