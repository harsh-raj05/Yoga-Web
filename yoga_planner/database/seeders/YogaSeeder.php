<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YogaSession;

class YogaSeeder extends Seeder
{
    public function run()
    {
        YogaSession::truncate();

        $sessions = [
            // ================= STRESS RELIEF =================
            [
                'name' => 'Restorative Deep Stretch',
                'goal' => 'stress_relief',
                'level' => 'beginner',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A gentle, slow-paced routine designed to ease tension, soothe the nervous system, and release tightness in the neck, shoulders, and lower back.',
                    'steps' => [
                        [
                            'name' => 'Child’s Pose (Balasana)',
                            'duration' => 120,
                            'instruction' => 'Kneel on the floor, touch your big toes together, sit on your heels, and separate your knees about hip-width. Fold forward, laying your torso between your thighs and stretching your arms forward on the mat.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Cat-Cow Stretch (Marjaryasana)',
                            'duration' => 120,
                            'instruction' => 'Start on your hands and knees in a tabletop position. Inhale, drop your belly and lift your chest (Cow). Exhale, round your spine toward the ceiling and tuck your chin (Cat). Move smoothly.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Downward-Facing Dog (Adho Mukha Svanasana)',
                            'duration' => 120,
                            'instruction' => 'From tabletop, lift your hips up and back, straightening your legs. Press your hands firmly into the mat, relax your neck, and pedal your feet out gently to warm up the calves and hamstrings.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Corpse Pose (Savasana)',
                            'duration' => 120,
                            'instruction' => 'Lie flat on your back, legs spread wider than hip-width, arms relaxed at your sides with palms facing up. Close your eyes, let go of all muscle tension, and breathe naturally.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Unwind & Reset Flow',
                'goal' => 'stress_relief',
                'level' => 'intermediate',
                'duration' => 10,
                'description' => json_encode([
                    'intro' => 'A flowing practice to bridge the gap between active movement and meditative stillness, focusing on breathing into deeper hip openers.',
                    'steps' => [
                        [
                            'name' => 'Cobra Pose (Bhujangasana)',
                            'duration' => 150,
                            'instruction' => 'Lie prone on the floor. Place your hands under your shoulders, hug elbows to your ribs. Inhale and gently lift your chest off the mat, keeping your pubic bone anchored.',
                            'image' => 'https://images.unsplash.com/photo-1575052814086-f385e2e2ad1b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Half Pigeon Pose (Ardha Kapotasana)',
                            'duration' => 180,
                            'instruction' => 'Bring your right knee forward towards your right wrist. Slide your left leg straight back behind you. Lower your hips toward the floor and fold forward over your front shin to feel a deep hip stretch.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Bridge Pose (Setu Bandhasana)',
                            'duration' => 150,
                            'instruction' => 'Lie on your back, knees bent, feet flat on the floor hip-width apart. Press into your feet and lift your hips high, clasping your hands underneath your back and rolling your shoulders in.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Seated Spinal Twist (Ardha Matsyendrasana)',
                            'duration' => 120,
                            'instruction' => 'Sit tall with legs extended. Bend right knee, cross it over left leg. Place right hand behind you, hook left elbow outside right knee. Inhale to lift, exhale to twist deeply.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Spinal Alignment & Open Hips',
                'goal' => 'stress_relief',
                'level' => 'advanced',
                'duration' => 12,
                'description' => json_encode([
                    'intro' => 'A deeply immersive practice targeting spinal articulation, core strength, and advanced hip socket mobilization to clear out stored emotional stress.',
                    'steps' => [
                        [
                            'name' => 'Camel Pose (Ustrasana)',
                            'duration' => 180,
                            'instruction' => 'Kneel on your shins. Inhale and reach your hands back to your heels one by one, arching your spine and pressing your chest and hips forward. Let your head drop back gently.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Wheel Pose (Urdhva Dhanurasana)',
                            'duration' => 180,
                            'instruction' => 'Lie flat, bend knees. Place hands next to ears, fingers pointing to shoulders. Press into hands and feet, lifting your entire body into an arch. Breathe deeply through the chest opening.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Crow Pose (Bakasana)',
                            'duration' => 180,
                            'instruction' => 'Squat down, place hands flat on the mat. Place knees against the back of your triceps near your armpits. Lean forward, transferring your weight onto your hands, and lift your toes off the floor.',
                            'image' => 'https://images.unsplash.com/photo-1599447421416-3414500d18a5?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Bound Angle Pose (Baddha Konasana)',
                            'duration' => 180,
                            'instruction' => 'Sit erect, bend knees and pull your feet close to the pelvis. Press the soles of your feet together, hold your feet, and gently fold your chest down towards the toes.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],

            // ================= WEIGHT LOSS =================
            [
                'name' => 'Sun Salutation Mastery',
                'goal' => 'weight_loss',
                'level' => 'beginner',
                'duration' => 6,
                'description' => json_encode([
                    'intro' => 'A dynamic set of 12 linked postures performed in a continuous loop to elevate heart rate, build core warmth, and promote metabolic efficiency.',
                    'steps' => [
                        [
                            'name' => 'Pranamasana (Prayer Pose)',
                            'duration' => 60,
                            'instruction' => 'Stand straight with feet together, palms joined together in a prayer pose at your chest. Inhale and exhale slowly.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Hastauttanasana (Raised Arms Pose)',
                            'duration' => 60,
                            'instruction' => 'Inhale, lift your arms up and backward, stretching the whole body from your heels to the tips of your fingers. Press the pelvis slightly forward.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Hastapadasana (Standing Forward Bend)',
                            'duration' => 60,
                            'instruction' => 'Exhale, bend forward from the hips, keeping the spine straight. Bring the hands down to touch the feet or place them beside your feet on the floor.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Ashwa Sanchalanasana (Equestrian Pose)',
                            'duration' => 60,
                            'instruction' => 'Inhale, push your right leg back as far as comfortable. Lower the right knee to the floor and look upward.',
                            'image' => 'https://images.unsplash.com/photo-1552196563-55cd4e45efb3?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Dandasana (Plank Pose)',
                            'duration' => 60,
                            'instruction' => 'Inhale, slide your left leg back to join the right. Keep your body straight as a rod, engaging your core and shoulders.',
                            'image' => 'https://images.unsplash.com/photo-1599447421416-3414500d18a5?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Ashtanga Namaskara (Eight-Limbed Salute)',
                            'duration' => 60,
                            'instruction' => 'Gently bring your knees down to the floor and exhale. Take the hips back slightly, slide forward, resting chest and chin on the floor. Keep hips slightly elevated.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Cardio Yoga Burn',
                'goal' => 'weight_loss',
                'level' => 'intermediate',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A intermediate flow designed to create muscular endurance, engage major leg and back muscle groups, and burn active calories.',
                    'steps' => [
                        [
                            'name' => 'Warrior I (Virabhadrasana I)',
                            'duration' => 120,
                            'instruction' => 'Step your right foot forward, bend your right knee to 90 degrees. Turn left foot out 45 degrees. Reach arms straight overhead, squaring your chest forward.',
                            'image' => 'https://images.unsplash.com/photo-1552196563-55cd4e45efb3?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Warrior II (Virabhadrasana II)',
                            'duration' => 120,
                            'instruction' => 'From Warrior I, open your arms out wide, parallel to the floor, gazing forward over your right hand. Keep the front knee stacked right over the ankle.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Reverse Warrior (Viparita Virabhadrasana)',
                            'duration' => 120,
                            'instruction' => 'Inhale, sweep your right hand up and back, arching into a side stretch, while sliding your left hand down your back thigh. Keep the front knee deeply bent.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Chair Pose (Utkatasana)',
                            'duration' => 120,
                            'instruction' => 'Stand feet together. Bend your knees deeply and sink your hips back as if sitting in an imaginary chair, raising your arms straight alongside your ears. Keep core tight.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Power Core Vinyasa',
                'goal' => 'weight_loss',
                'level' => 'advanced',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'An intense, core-focused flow combining long isometric holds, arm balances, and rapid transitional plank work to maximize definition.',
                    'steps' => [
                        [
                            'name' => 'Plank To Chaturanga Push-ups',
                            'duration' => 120,
                            'instruction' => 'From a high plank, shift weight forward. Exhale and lower halfway down keeping elbows tucked into your ribs (Chaturanga). Press back up to high plank. Repeat with slow breaths.',
                            'image' => 'https://images.unsplash.com/photo-1599447421416-3414500d18a5?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Side Plank with Crunch (Vasisthasana)',
                            'duration' => 120,
                            'instruction' => 'Pivot onto the outer edge of your left foot and lift your right arm up. Bring right knee to right elbow, crunching the oblique, then extend back out. Balance and breathe.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Boat Pose (Navasana)',
                            'duration' => 120,
                            'instruction' => 'Sit on your sits bones, lift your legs straight off the floor at a 45-degree angle, and reach your arms straight forward parallel to the floor. Keep spine tall and long.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Crow Pose (Bakasana)',
                            'duration' => 120,
                            'instruction' => 'Squat low, hands flat. Rest knees high on the triceps. Tilt forward, look slightly ahead, and squeeze your heels in toward your glutes as you fly.',
                            'image' => 'https://images.unsplash.com/photo-1599447421416-3414500d18a5?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],

            // ================= FLEXIBILITY =================
            [
                'name' => 'Morning Flexibility Awakening',
                'goal' => 'flexibility',
                'level' => 'beginner',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A perfect start to your day. This beginner-friendly stretching series wakes up cold joints and opens up common tight spots.',
                    'steps' => [
                        [
                            'name' => 'Neck & Shoulder Rolls',
                            'duration' => 120,
                            'instruction' => 'Sit comfortably. Inhale, roll your shoulders up to your ears, then exhale them down your back. Gently circle your neck in clockwise and counter-clockwise sweeps.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Butterfly Pose (Baddha Konasana)',
                            'duration' => 120,
                            'instruction' => 'Sit erect, pull the soles of your feet together in front of you. Hold ankles, sit tall, and flap knees down gently like wings. Fold forward from the chest for a deeper inner thigh stretch.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Standing Forward Fold (Uttanasana)',
                            'duration' => 120,
                            'instruction' => 'Stand tall. Exhale and hang forward over your legs. Bend your knees slightly if needed, grab opposite elbows with your hands, and sway gently to release the lower back and neck.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Seated Forward Fold (Paschimottanasana)',
                            'duration' => 120,
                            'instruction' => 'Sit with legs extended straight. Inhale to raise arms, exhale and fold from the hips, reaching for shins, ankles, or feet. Keep your chest open and pull forward rather than down.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Hamstring & Hip Release',
                'goal' => 'flexibility',
                'level' => 'intermediate',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'A focused flexibility flow designed for deep hamstrings and hip flexor release, perfect for desk workers and runners.',
                    'steps' => [
                        [
                            'name' => 'Low Lunge Stretch (Anjaneyasana)',
                            'duration' => 120,
                            'instruction' => 'Step right foot forward between your hands. Lower your left knee to the floor. Inhale, sweep arms overhead and sink hips down and forward to stretch the left hip flexor.',
                            'image' => 'https://images.unsplash.com/photo-1552196563-55cd4e45efb3?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Pyramid Pose (Parsvottanasana)',
                            'duration' => 120,
                            'instruction' => 'Step rear foot closer. Straighten both legs, feet flat. Inhale to lengthen your spine, exhale and fold your torso over your front leg. Keep your hips square to the front.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Lizard Lunge (Utthan Pristhasana)',
                            'duration' => 120,
                            'instruction' => 'Step front foot wide to the outer edge of your mat. Bring both hands/elbows to the inside of your foot, lowering your back knee down. Sway gently to stretch the deep inner hip.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Wide-Legged Forward Fold (Prasarita)',
                            'duration' => 120,
                            'instruction' => 'Stand wide-legged, feet parallel. Place hands on hips, inhale. Exhale, fold forward from your hip joints, dropping your head low and placing hands on the floor between your feet.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Full-Split Preparation Flow',
                'goal' => 'flexibility',
                'level' => 'advanced',
                'duration' => 8,
                'description' => json_encode([
                    'intro' => 'An advanced-level routine focusing on progressive dynamic opening of hamstrings and hip sockets to prepare the lower body for the full splits.',
                    'steps' => [
                        [
                            'name' => 'Deep Lizard Lunge to Forearms',
                            'duration' => 120,
                            'instruction' => 'Lunge right foot forward. Drop left knee. Lower both forearms flat onto the floor inside the right foot. Tuck back toes and lift the back knee, pushing back through the left heel.',
                            'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'pulse-slow'
                        ],
                        [
                            'name' => 'Half Splits (Ardha Hanumanasana)',
                            'duration' => 120,
                            'instruction' => 'From a lunge, slide your hips back until they stack right over your back knee. Straighten your front leg, flex your front foot, and fold your chest forward keeping spine long.',
                            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'wave-slow'
                        ],
                        [
                            'name' => 'Hero Pose (Virasana)',
                            'duration' => 120,
                            'instruction' => 'Kneel on the floor, knees together, feet slightly wider than hips. Sit your hips down onto the floor between your feet. If comfortable, lean back onto your forearms or lie flat.',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'glowing-effect'
                        ],
                        [
                            'name' => 'Full Split Attempt (Hanumanasana)',
                            'duration' => 120,
                            'instruction' => 'From half splits, slide your front heel forward and push your back knee back. Keep hips square. Use hands on yoga blocks for support and sink down slowly on each exhale.',
                            'image' => 'https://images.unsplash.com/photo-1603988363607-e1e4a66962c6?w=800&q=80&auto=format&fit=crop',
                            'animation_class' => 'breath-circle'
                        ]
                    ]
                ])
            ],
        ];

        YogaSession::insert($sessions);
    }
}
