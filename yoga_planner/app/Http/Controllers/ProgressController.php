<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function store()
    {
        Progress::create([
            'user_id' => auth()->id(),
            'date' => now()->toDateString(),
            'completed' => true
        ]);

        return back()->with('success', 'Great job! Plan completed 🎉');
    }
}