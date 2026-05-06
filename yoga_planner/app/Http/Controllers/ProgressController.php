<?php

namespace App\Http\Controllers;

use App\Models\Progress;

class ProgressController extends Controller
{
    public function store()
    {
        Progress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'date' => now()->toDateString(),
            ],
            [
                'completed' => true,
            ]
        );

        return back()->with('success', 'Great job! Today\'s plan has been marked complete.');
    }
}
