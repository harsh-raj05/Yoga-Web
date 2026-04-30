<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeditationSession extends Model
{
    //
    protected $fillable = ['name', 'type', 'duration', 'description'];
}
