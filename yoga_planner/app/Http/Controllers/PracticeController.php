<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YogaSession;
use App\Models\MeditationSession;

class PracticeController extends Controller
{
    public function start($type, $id)
    {
        if (!in_array($type, ['yoga', 'meditation'])) {
            abort(404, 'Invalid practice type');
        }

        $session = $type === 'yoga' 
            ? YogaSession::findOrFail($id) 
            : MeditationSession::findOrFail($id);

        $decodedData = json_decode($session->description, true);

        // Fallback in case description is plain text instead of JSON
        if (json_last_error() !== JSON_ERROR_NONE || !$decodedData) {
            $decodedData = [
                'intro' => $session->description ?: 'A calming practice session to center your mind and warm up your body.',
                'steps' => [
                    [
                        'name' => $session->name,
                        'duration' => $session->duration * 60, // convert minutes to seconds
                        'instruction' => $session->description ?: 'Focus on your posture, breathing, and presence.',
                        'image' => $type === 'yoga' 
                            ? 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop'
                            : 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                        'animation_class' => 'breath-circle'
                    ]
                ]
            ];
        }

        return view('practice', [
            'type' => $type,
            'session' => $session,
            'data' => $decodedData
        ]);
    }
}
