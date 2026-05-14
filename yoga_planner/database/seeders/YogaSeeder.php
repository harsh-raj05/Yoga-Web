<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YogaSession;

class YogaSeeder extends Seeder
{
    public function run()
    {
        YogaSession::insert([
            [
                'name' => 'Surya Namaskar',
                'goal' => 'weight_loss',
                'level' => 'beginner',
                'duration' => 10,
                'description' => 'Full body warm-up'
            ],
            [
                'name' => 'Child Pose',
                'goal' => 'stress_relief',
                'level' => 'beginner',
                'duration' => 5,
                'description' => 'Relaxing pose'
            ],
            [
                'name' => 'Cobra Pose',
                'goal' => 'flexibility',
                'level' => 'intermediate',
                'duration' => 8,
                'description' => 'Improves spine flexibility'
            ],
            [
                'name' => 'Warrior Pose',
                'goal' => 'weight_loss',
                'level' => 'intermediate',
                'duration' => 12,
                'description' => 'Builds strength'
            ]
        ]);
    }
}
