<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'user_id',
        'age',
        'goal',
        'experience_level',
        'available_time',
    ];
}