<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;
use App\Models\YogaSession;
use App\Models\MeditationSession;

class PlannerController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Get user preference
        $preference = Preference::where('user_id', $userId)->first();

        if (!$preference) {
            return redirect('/preferences')->with('error', 'Please set your preferences first.');
        }

        // Fetch yoga based on goal & level
        $yoga = YogaSession::where('goal', $preference->goal)
            ->where('level', $preference->experience_level)
            ->get();

        // Fetch meditation based on goal
        $meditation = MeditationSession::where('type', $preference->goal)->get();
        
        $progressDates = \App\Models\Progress::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->unique()
            ->values();

        $streak = 0;
        
        foreach ($progressDates as $date) {
            if ($date == now()->subDays($streak)->toDateString()) {
                $streak++;
            } else {
                break;
            }
        }

        return view('plan', compact('yoga', 'meditation', 'preference', 'streak'));
    }
}
