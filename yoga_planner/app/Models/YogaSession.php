<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YogaSession extends Model
{
    //
    protected $fillable = ['name', 'goal', 'level', 'duration', 'description'];
}
