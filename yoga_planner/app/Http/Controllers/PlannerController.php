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

        // Map preference goal to meditation type enum: ['stress_relief', 'focus', 'sleep']
        $meditationType = match ($preference->goal) {
            'weight_loss' => 'focus',
            'flexibility' => 'sleep',
            'stress_relief' => 'stress_relief',
            default => 'focus',
        };

        // Fetch meditation based on mapped type
        $meditation = MeditationSession::where('type', $meditationType)->get();
        
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

        // Goal-adaptive premium daily diet menu recommendations (with Veg and Non-veg choices + calories)
        $dietPlan = [
            'weight_loss' => [
                'breakfast' => [
                    'veg' => [
                        ['name' => 'Berry Protein Oatmeal', 'calories' => 320],
                        ['name' => 'Spinach & Low-Fat Feta Omelette', 'calories' => 280],
                        ['name' => 'Chia Seed Berry Pudding', 'calories' => 240],
                        ['name' => 'Scrambled Tofu with Turmeric', 'calories' => 260],
                        ['name' => 'Avocado Whole Wheat Toast', 'calories' => 290]
                    ],
                    'non_veg' => [
                        ['name' => 'Egg White Scramble with Turkey Bacon', 'calories' => 310],
                        ['name' => 'Smoked Salmon & Whole Grain Toast', 'calories' => 360],
                        ['name' => 'Whole Egg & Turkey Ham Omelette', 'calories' => 340],
                        ['name' => 'Chicken Sausage & Scrambled Eggs', 'calories' => 330],
                        ['name' => 'Greek Yogurt Bowl with Chicken Breast Strips', 'calories' => 350]
                    ]
                ],
                'lunch' => [
                    'veg' => [
                        ['name' => 'Spiced Chickpea Buddha Bowl', 'calories' => 420],
                        ['name' => 'Quinoa & Black Bean Salad with Lime', 'calories' => 390],
                        ['name' => 'Grilled Paneer & Mixed Greens', 'calories' => 440],
                        ['name' => 'High-Protein Lentil Soup with Toast', 'calories' => 360],
                        ['name' => 'Tempeh Veggie Hummus Wrap', 'calories' => 410]
                    ],
                    'non_veg' => [
                        ['name' => 'Lemon Herb Grilled Chicken Salad', 'calories' => 450],
                        ['name' => 'Turkey Breast & Spinach Quinoa Bowl', 'calories' => 430],
                        ['name' => 'Tuna Salad Lettuce Boats', 'calories' => 380],
                        ['name' => 'Grilled Shrimp & Broccoli Bowls', 'calories' => 410],
                        ['name' => 'Lean Beef & Asparagus Stir-Fry', 'calories' => 480]
                    ]
                ],
                'dinner' => [
                    'veg' => [
                        ['name' => 'Teriyaki Glazed Tempeh & Brown Rice', 'calories' => 460],
                        ['name' => 'Baked Tofu & Roasted Broccoli Greens', 'calories' => 410],
                        ['name' => 'Sweet Potato & Lentil Shepherd\'s Pie', 'calories' => 450],
                        ['name' => 'Vegetable Stir-Fry with Cauliflower Rice', 'calories' => 320],
                        ['name' => 'Paneer Tikka with Sautéed Bell Peppers', 'calories' => 480]
                    ],
                    'non_veg' => [
                        ['name' => 'Seared Salmon & Asparagus Bowl', 'calories' => 490],
                        ['name' => 'Baked Fish with Ginger Quinoa', 'calories' => 430],
                        ['name' => 'Beef Sirloin & Garlic Broccoli Stir-Fry', 'calories' => 520],
                        ['name' => 'Grilled Chicken Breast & Sautéed Zucchini', 'calories' => 450],
                        ['name' => 'Turkey Meatball Zucchini Noodles', 'calories' => 390]
                    ]
                ],
                'snacks' => [
                    'veg' => [
                        ['name' => 'Greek Yogurt with Blueberries', 'calories' => 150],
                        ['name' => 'Mixed Raw Almonds & Walnuts', 'calories' => 180],
                        ['name' => 'Hummus with Carrot & Cucumber Sticks', 'calories' => 140],
                        ['name' => 'Roasted Edamame with Sea Salt', 'calories' => 160],
                        ['name' => 'Cottage Cheese with Flax Seeds', 'calories' => 170]
                    ],
                    'non_veg' => [
                        ['name' => 'Hard-Boiled Eggs with Sea Salt', 'calories' => 140],
                        ['name' => 'Turkey Breast Roll-ups with Cucumber', 'calories' => 120],
                        ['name' => 'Tuna Cucumber Bites', 'calories' => 150],
                        ['name' => 'Chicken Jerky Strips', 'calories' => 130],
                        ['name' => 'Egg Salad Lettuce Wraps', 'calories' => 160]
                    ]
                ]
            ],
            'stress_relief' => [
                'breakfast' => [
                    'veg' => [
                        ['name' => 'Avocado & Poached Egg Sourdough Toast', 'calories' => 380],
                        ['name' => 'Almond Butter & Banana Oatmeal', 'calories' => 390],
                        ['name' => 'Blueberry Oat Smoothie Bowl', 'calories' => 340],
                        ['name' => 'Cinnamon Pear & Chia Seed Pudding', 'calories' => 310],
                        ['name' => 'Warm Chamomile Oats with Walnuts', 'calories' => 360]
                    ],
                    'non_veg' => [
                        ['name' => 'Smoked Salmon & Scrambled Eggs on Sourdough', 'calories' => 420],
                        ['name' => 'Turkey Breast & Spinach Omelette', 'calories' => 350],
                        ['name' => 'Poached Eggs over Chicken & Veggie Hash', 'calories' => 390],
                        ['name' => 'Egg, Spinach & Chicken Sausage Breakfast Wrap', 'calories' => 410],
                        ['name' => 'Greek Yogurt Bowl with Honey & Bacon Bits', 'calories' => 380]
                    ]
                ],
                'lunch' => [
                    'veg' => [
                        ['name' => 'Mediterranean Hummus & Veggie Platter', 'calories' => 420],
                        ['name' => 'Soothing Lentil & Baby Spinach Soup', 'calories' => 380],
                        ['name' => 'Rainbow Quinoa Salad with Lemon Dressing', 'calories' => 410],
                        ['name' => 'Chickpea & Avocado Smashed Wrap', 'calories' => 430],
                        ['name' => 'Grilled Paneer & Roasted Sweet Potato Salad', 'calories' => 450]
                    ],
                    'non_veg' => [
                        ['name' => 'Roasted Turkey & Avocado Greens Plate', 'calories' => 460],
                        ['name' => 'Seared Salmon & Cucumber Salad', 'calories' => 490],
                        ['name' => 'Lemon Garlic Chicken Spinach Soup', 'calories' => 390],
                        ['name' => 'Tuna Avocado Poke Bowl', 'calories' => 450],
                        ['name' => 'Grilled Chicken Salad with Apple & Walnuts', 'calories' => 480]
                    ]
                ],
                'dinner' => [
                    'veg' => [
                        ['name' => 'Creamy Paneer & Spinach Curry (Palak Paneer)', 'calories' => 490],
                        ['name' => 'Roasted Tofu with Sesame Sweet Potato Slices', 'calories' => 440],
                        ['name' => 'Stuffed Bell Peppers with Quinoa & Lentils', 'calories' => 420],
                        ['name' => 'Rich Vegetable & Chickpea Coconut Korma', 'calories' => 470],
                        ['name' => 'Warm Mushroom & Quinoa Risotto', 'calories' => 430]
                    ],
                    'non_veg' => [
                        ['name' => 'Roasted Turkey Plate with Sweet Potatoes', 'calories' => 480],
                        ['name' => 'Seared Salmon Fillet with Wild Rice & Asparagus', 'calories' => 520],
                        ['name' => 'Slow-Cooked Herb Chicken with Steamed Broccoli', 'calories' => 450],
                        ['name' => 'Baked Cod with Sautéed Bok Choy & Ginger', 'calories' => 410],
                        ['name' => 'Grass-fed Sirloin Steak with Roasted Brussels Sprouts', 'calories' => 560]
                    ]
                ],
                'snacks' => [
                    'veg' => [
                        ['name' => 'Soothing Dark Chocolate (70%+ Cacao) & Raw Almonds', 'calories' => 190],
                        ['name' => 'Fresh Pear Slices & Roasted Walnuts', 'calories' => 170],
                        ['name' => 'Pumpkin Seeds & Organic Dried Figs', 'calories' => 160],
                        ['name' => 'Cottage Cheese with Honey & Flax Seeds', 'calories' => 180],
                        ['name' => 'Celery Sticks with Smooth Almond Butter', 'calories' => 150]
                    ],
                    'non_veg' => [
                        ['name' => 'Hard-Boiled Eggs with Walnut Halves', 'calories' => 200],
                        ['name' => 'Smoked Salmon Rolls with Cream Cheese', 'calories' => 210],
                        ['name' => 'Prosciutto-Wrapped Asparagus Spears', 'calories' => 160],
                        ['name' => 'Turkey Breast Jerky & Pumpkin Seeds', 'calories' => 180],
                        ['name' => 'Bacon-Wrapped Avocado Slices', 'calories' => 240]
                    ]
                ]
            ],
            'flexibility' => [
                'breakfast' => [
                    'veg' => [
                        ['name' => 'Alkaline Green Smoothie Bowl with Sunflower Seeds', 'calories' => 330],
                        ['name' => 'Antioxidant Chia Berry Pudding with Strawberries', 'calories' => 310],
                        ['name' => 'Tropical Green Coconut Smoothie Bowl', 'calories' => 320],
                        ['name' => 'Warm Oats with Flax Seeds & Sliced Berries', 'calories' => 340],
                        ['name' => 'Scrambled Tofu with Baby Spinach & Turmeric', 'calories' => 280]
                    ],
                    'non_veg' => [
                        ['name' => 'Omega-3 Rich Salmon & Spinach Scrambled Eggs', 'calories' => 390],
                        ['name' => 'Poached Eggs over Avocado Toast & Chia Seeds', 'calories' => 380],
                        ['name' => 'Greek Yogurt Bowl with Berries & Chia Seeds', 'calories' => 350],
                        ['name' => 'Egg White Omelette with Lean Chicken Strips', 'calories' => 340],
                        ['name' => 'Turmeric Spiced Eggs with Smoked Salmon', 'calories' => 390]
                    ]
                ],
                'lunch' => [
                    'veg' => [
                        ['name' => 'Tempeh & Roasted Beetroot Rocket Salad', 'calories' => 430],
                        ['name' => 'Rainbow Tofu & Veggie Wrap with Beet Hummus', 'calories' => 410],
                        ['name' => 'Spiced Lentil Soup with Sweet Potato Mash', 'calories' => 390],
                        ['name' => 'Chickpea & Spinach Salad with Tahini Dressing', 'calories' => 420],
                        ['name' => 'Avocado & Grilled Paneer Greens Salad', 'calories' => 450]
                    ],
                    'non_veg' => [
                        ['name' => 'Omega-3 Salmon Salad Wrap', 'calories' => 460],
                        ['name' => 'High-Protein Tempeh Wrap with Chicken Strips', 'calories' => 440],
                        ['name' => 'Lemon Herb Chicken & Beetroot Quinoa Bowl', 'calories' => 430],
                        ['name' => 'Tuna, Olive Oil & Cucumber Greens Salad', 'calories' => 420],
                        ['name' => 'Shredded Turkey Breast & Avocado Spinach Bowl', 'calories' => 450]
                    ]
                ],
                'dinner' => [
                    'veg' => [
                        ['name' => 'Lentil & Sweet Potato Shepherd\'s Pie', 'calories' => 490],
                        ['name' => 'Spiced Chickpea & Cauliflower Turmeric Curry', 'calories' => 430],
                        ['name' => 'Baked Tofu with Sautéed Asparagus & Jasmine Rice', 'calories' => 450],
                        ['name' => 'Mushroom & Quinoa Sauté with Ghee', 'calories' => 410],
                        ['name' => 'Paneer Stir-Fry with Bok Choy & Broccoli', 'calories' => 480]
                    ],
                    'non_veg' => [
                        ['name' => 'Ginger Glazed Baked Cod with Jasmine Rice', 'calories' => 490],
                        ['name' => 'Seared Salmon Fillet with Asparagus Spears', 'calories' => 510],
                        ['name' => 'Chicken Sirloin Stir-Fry with Ginger Soy Sauce', 'calories' => 460],
                        ['name' => 'Turkey Breast with Rosemary & Sweet Potatoes', 'calories' => 450],
                        ['name' => 'Baked Fish with Asparagus & Hollandaise Sauce', 'calories' => 530]
                    ]
                ],
                'snacks' => [
                    'veg' => [
                        ['name' => 'Almond Milk Chia Pudding with Fresh Strawberries', 'calories' => 170],
                        ['name' => 'Alkaline Raw Pumpkin Seeds & Medjool Dates', 'calories' => 180],
                        ['name' => 'Raw Walnuts & Organic Dried Figs', 'calories' => 160],
                        ['name' => 'Apple Slices with Creamy Almond Butter', 'calories' => 150],
                        ['name' => 'Roasted Edamame with Pink Himalayan Salt', 'calories' => 160]
                    ],
                    'non_veg' => [
                        ['name' => 'Hard-Boiled Eggs with Chia Seed Seasoning', 'calories' => 150],
                        ['name' => 'Turkey Roll-ups with Spinach & Cream Cheese', 'calories' => 140],
                        ['name' => 'Tuna-Filled Avocado Halves', 'calories' => 220],
                        ['name' => 'Prosciutto Wrapped Melon Slices', 'calories' => 130],
                        ['name' => 'Smoked Salmon Roll-ups with Sesame Seeds', 'calories' => 170]
                    ]
                ]
            ]
        ];

        $goal = $preference->goal ?? 'stress_relief';
        $nutritionPlan = $dietPlan[$goal] ?? $dietPlan['stress_relief'];
        
        $dietLabels = [
            'weight_loss' => 'Weight Loss Support Diet Plan',
            'stress_relief' => 'Stress Relief Support Diet Plan',
            'flexibility' => 'Flexibility Support Diet Plan',
        ];
        $dietLabel = $dietLabels[$goal] ?? 'Balanced Diet Nutrition Guide';

        return view('plan', compact(
            'yoga', 
            'meditation', 
            'preference', 
            'streak', 
            'planVideoRecommendations', 
            'nutritionPlan', 
            'dietLabel'
        ));
    }
}
