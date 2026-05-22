<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeditationSession;

class MeditationSeeder extends Seeder
{
    public function run()
    {
        MeditationSession::truncate();

        $sessions = [
            [
                'name' => 'Deep Calming Breathwork (Pranayama)',
                'type' => 'stress_relief',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A traditional yogic breathwork session designed to down-regulate the nervous system, lower the heart rate, and clear mental chatter.',
                    'steps' => [
                        [
                            'name' => 'Comfortable Sitting & Center',
                            'duration' => 120,
                            'instruction' => 'Sit comfortably with a tall spine, either cross-legged on the floor or in a chair. Close your eyes, place hands on knees palms up, and tune into your natural breath.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Sama Vritti (Equal Breathing)',
                            'duration' => 120,
                            'instruction' => 'Inhale through your nose for a count of 4, then exhale through your nose for a count of 4. Keep your breaths steady, smooth, and quiet, filling the lungs completely.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ],
                        [
                            'name' => 'Nadi Shodhana (Alternate Nostril)',
                            'duration' => 120,
                            'instruction' => 'Use your right thumb to close your right nostril. Inhale through the left. Close left, exhale through right. Inhale through right, close right, exhale through left. Continue calmly.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Return to Center & Rest',
                            'duration' => 120,
                            'instruction' => 'Release your hand. Sit in silence, breathing naturally. Observe the physical sensations and the quietude of your mind before completing the practice.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Discipline & Mental Strength',
                'type' => 'focus',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A focus-based meditation designed to support mental clarity, bolster personal resolve, and reinforce consistent, positive habits.',
                    'steps' => [
                        [
                            'name' => 'Finding Stillness',
                            'duration' => 120,
                            'instruction' => 'Sit upright and alert. Relax your shoulders, tuck your chin slightly. Take three deep, grounding breaths, exhaling through your mouth to drop any active stress.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Single-Pointed Focus (Dharana)',
                            'duration' => 120,
                            'instruction' => 'Bring all your attention to the sensation of breath passing the rims of your nostrils. When your mind drifts to distractions, gently but firmly redirect it to the breath.',
                            'image' => 'https://images.unsplash.com/photo-1599447421416-3414500d18a5?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ],
                        [
                            'name' => 'Visualizing Consistency & Intention',
                            'duration' => 120,
                            'instruction' => 'Visualize yourself completing your daily routines with ease and dedication. Connect with the feelings of pride, strength, and health that follow a consistent practice.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Focus Anchoring',
                            'duration' => 120,
                            'instruction' => 'Silently repeat the affirmation: "I am strong, I am focused, and I respect my wellness commitments." Take one deep breath and gently blink your eyes open.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Savasana Deep Muscle Release',
                'type' => 'sleep',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A deeply soothing, lying-down body scan meditation aimed at fully releasing muscular tension to prepare your body for deep, restorative sleep.',
                    'steps' => [
                        [
                            'name' => 'Laying Down & Letting Go',
                            'duration' => 120,
                            'instruction' => 'Lie down flat on your back on your mat or in bed. Rest your arms at your side, palms facing up. Cover yourself with a blanket if you like. Take a deep breath and let your body sink.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Body Scan & Relaxation',
                            'duration' => 120,
                            'instruction' => 'Draw your awareness down to your toes. Inhale, and as you exhale, imagine them melting. Slowly sweep this awareness up through your calves, thighs, pelvis, and stomach.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ],
                        [
                            'name' => 'Tense and Release (Upper Body)',
                            'duration' => 120,
                            'instruction' => 'Inhale, shrug shoulders to ears, squeeze hands into fists, squeeze facial muscles tight. Hold for 3 seconds. Exhale fully, letting everything drop and sag onto the floor.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Entering Restorative Rest',
                            'duration' => 120,
                            'instruction' => 'Let go of all control of your breath and focus. Allow yourself to hover in the peaceful, silent space of deep relaxation, drifting toward natural rest.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ]
                    ]
                ])
            ]
        ];

        MeditationSession::insert($sessions);
    }
}