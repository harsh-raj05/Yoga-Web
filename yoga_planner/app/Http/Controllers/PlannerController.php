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

        $goalLabels = [
            'weight_loss' => 'Weight Loss',
            'stress_relief' => 'Stress Relief',
            'flexibility' => 'Flexibility',
        ];

        $levelLabels = [
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
        ];

        $yogaVideos = [
            'weight_loss' => [
                'title' => 'Total Body Yoga Flow',
                'subtitle' => 'A more energetic yoga class to support movement consistency and full-body engagement.',
                'youtube_id' => 'qiu1SYtAdBg',
                'duration' => 'Flow class',
            ],
            'stress_relief' => [
                'title' => 'Relaxing Chair Yoga Reset',
                'subtitle' => 'A gentle session designed to slow the body down and ease stress through mindful movement.',
                'youtube_id' => 'IKW8X0-2Eww',
                'duration' => '10 min',
            ],
            'flexibility' => [
                'title' => 'Gentle Flexibility Yoga',
                'subtitle' => 'A softer stretching-focused practice to open the body without adding unnecessary intensity.',
                'youtube_id' => '1DYH5ud3zHo',
                'duration' => '18 min',
            ],
        ];

        $meditationVideos = [
            'weight_loss' => [
                'title' => 'Motivation and Positivity Meditation',
                'subtitle' => 'A short guided meditation to support discipline, focus, and a lighter mental reset.',
                'youtube_id' => '-9KLB2HI9BI',
                'duration' => '10 min',
            ],
            'stress_relief' => [
                'title' => 'Stress Relief Meditation',
                'subtitle' => 'A calming guided meditation to settle anxious energy and make the practice more restorative.',
                'youtube_id' => 'O-6f5wQXSu8',
                'duration' => '10 min',
            ],
            'flexibility' => [
                'title' => 'Deep Relaxation Meditation',
                'subtitle' => 'A softer recovery-oriented meditation to help the nervous system release tension after stretching.',
                'youtube_id' => 'lu_cLaBTXio',
                'duration' => '10 min',
            ],
        ];

        $planVideoRecommendations = [
            'goal_label' => $goalLabels[$preference->goal] ?? ucfirst(str_replace('_', ' ', $preference->goal)),
            'level_label' => $levelLabels[$preference->experience_level] ?? ucfirst($preference->experience_level),
            'yoga' => $yogaVideos[$preference->goal] ?? $yogaVideos['stress_relief'],
            'meditation' => $meditationVideos[$preference->goal] ?? $meditationVideos['stress_relief'],
        ];

        return view('plan', compact('yoga', 'meditation', 'preference', 'streak', 'planVideoRecommendations'));
    }
}
