<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeditationSession;

class MeditationSeeder extends Seeder
{
    public function run()
    {
        MeditationSession::insert([
            [
                'name' => 'Breathing Meditation',
                'type' => 'stress_relief',
                'duration' => 10,
                'description' => 'Focus on breathing'
            ],
            [
                'name' => 'Mindfulness Meditation',
                'type' => 'focus',
                'duration' => 15,
                'description' => 'Improve concentration'
            ],
            [
                'name' => 'Sleep Meditation',
                'type' => 'sleep',
                'duration' => 20,
                'description' => 'Better sleep'
            ]
        ]);
    }
}