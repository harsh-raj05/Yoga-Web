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

        // Custom 15-way cross-referenced diet-goal recipe matrix
        $dietPlans = [
            'balanced' => [
                'label' => 'Balanced Nutrition Plan',
                'weight_loss' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Berry Protein Oatmeal',
                        'calories' => 380,
                        'macros' => ['carbs' => '45g', 'protein' => '25g', 'fat' => '8g'],
                        'ingredients' => ['1/2 cup Rolled Oats', '1 scoop Vanilla Whey Protein', '1/2 cup Blueberries', '1 tbsp Chia Seeds', '1 cup Unsweetened Almond Milk'],
                        'instructions' => 'Cook oats in almond milk, stir in protein powder, top with fresh blueberries and chia seeds.',
                        'image' => 'https://images.unsplash.com/photo-1517881917430-e70dfb3610aa?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Lemon Herb Grilled Chicken Salad',
                        'calories' => 450,
                        'macros' => ['carbs' => '12g', 'protein' => '40g', 'fat' => '15g'],
                        'ingredients' => ['150g Chicken Breast', '3 cups Mixed Salad Greens', '1/2 Cucumber', '1/2 Avocado', '1 tbsp Lemon Dressing'],
                        'instructions' => 'Slice grilled chicken, toss with mixed greens, cucumber, avocado, and olive oil lemon dressing.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Seared Salmon & Asparagus Bowl',
                        'calories' => 490,
                        'macros' => ['carbs' => '15g', 'protein' => '38g', 'fat' => '22g'],
                        'ingredients' => ['150g Wild Salmon Fillet', '2 cups Asparagus spears', '1/2 cup Cooked Quinoa', '1 tsp Garlic butter'],
                        'instructions' => 'Pan-sear salmon for 4 minutes per side. Serve alongside garlic-sautéed asparagus and warm quinoa.',
                        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Greek Yogurt & Almonds',
                        'calories' => 200,
                        'macros' => ['carbs' => '8g', 'protein' => '15g', 'fat' => '11g'],
                        'ingredients' => ['150g Plain Non-Fat Greek Yogurt', '12 Almonds', '1/2 tsp Honey'],
                        'instructions' => 'Top Greek yogurt with raw almond halves and a light drizzle of honey.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'stress_relief' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Avocado & Poached Egg Toast',
                        'calories' => 390,
                        'macros' => ['carbs' => '28g', 'protein' => '18g', 'fat' => '20g'],
                        'ingredients' => ['2 slices Sourdough Bread', '1/2 Ripe Avocado', '2 Poached Eggs', 'Pinch of Sea Salt & Red pepper flakes'],
                        'instructions' => 'Toast sourdough, mash avocado on top, place poached eggs, and season with sea salt and red pepper flakes.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Mediterranean Hummus & Veggie Plate',
                        'calories' => 440,
                        'macros' => ['carbs' => '44g', 'protein' => '12g', 'fat' => '18g'],
                        'ingredients' => ['3 tbsp Classic Hummus', '1 Whole Wheat Pita bread', '1/2 cup Cucumber slices', '1/2 cup Cherry Tomatoes', '4 Kalamata Olives'],
                        'instructions' => 'Arrange fresh cucumbers, cherry tomatoes, olives, toasted pita slices, and creamy hummus on a platter.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Mindfulness Roasted Turkey Plate',
                        'calories' => 480,
                        'macros' => ['carbs' => '30g', 'protein' => '35g', 'fat' => '15g'],
                        'ingredients' => ['150g Turkey Breast slice', '1 cup Sweet Potato wedges, roasted', '2 cups Sautéed Spinach', '1 tbsp Walnut dressing'],
                        'instructions' => 'Sauté spinach with garlic. Plate alongside roasted sweet potato wedges and lean roasted turkey slices.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Soothing Dark Chocolate & Almonds',
                        'calories' => 190,
                        'macros' => ['carbs' => '15g', 'protein' => '4g', 'fat' => '14g'],
                        'ingredients' => ['30g Dark Chocolate (70%+ Cacao)', '10 Raw Almonds'],
                        'instructions' => 'Enjoy raw almonds slowly alongside rich dark chocolate blocks to soothe the nervous system.',
                        'image' => 'https://images.unsplash.com/photo-1540838290-76171485a627?w=600&q=80&auto=format&fit=crop'
                    ]
                ],
                'flexibility' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Antioxidant Chia Berry Pudding',
                        'calories' => 310,
                        'macros' => ['carbs' => '24g', 'protein' => '8g', 'fat' => '15g'],
                        'ingredients' => ['3 tbsp Chia Seeds', '1 cup Coconut Milk', '1/2 cup Strawberries', '1 tsp Maple syrup'],
                        'instructions' => 'Stir chia seeds and coconut milk with maple syrup. Let chill overnight, and top with fresh strawberries.',
                        'image' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Rainbow Tofu & Veggie Wrap',
                        'calories' => 420,
                        'macros' => ['carbs' => '45g', 'protein' => '14g', 'fat' => '13g'],
                        'ingredients' => ['1 Whole Wheat Wrap', '2 tbsp Beet Hummus', '50g Baked Tofu', '1/2 cup Grated Carrots', '1/2 cup Spinach'],
                        'instructions' => 'Spread beet hummus on wrap, lay baked tofu slices, spinach, carrots, and cabbage. Roll up tightly.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Baked Fish with Ginger Rice',
                        'calories' => 510,
                        'macros' => ['carbs' => '22g', 'protein' => '40g', 'fat' => '24g'],
                        'ingredients' => ['150g Cod or Haddock fillet', '1 tsp Ginger paste', '1 cup Stir-fry Asparagus', '1/2 cup Jasmine Rice'],
                        'instructions' => 'Glaze cod with ginger and sesame oil, bake at 400F for 10 mins. Serve with jasmine rice and green stir-fry.',
                        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Pumpkin Seeds & Dried Figs',
                        'calories' => 170,
                        'macros' => ['carbs' => '18g', 'protein' => '6g', 'fat' => '7g'],
                        'ingredients' => ['2 tbsp Raw Pumpkin Seeds', '3 Dried Figs'],
                        'instructions' => 'Enjoy highly alkaline raw pumpkin seeds alongside magnesium-rich dried figs.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ]
                ]
            ],
            'vegetarian' => [
                'label' => 'Vegetarian Healing Plan',
                'weight_loss' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Fluffy Egg White & Spinach Omelette',
                        'calories' => 320,
                        'macros' => ['carbs' => '10g', 'protein' => '26g', 'fat' => '12g'],
                        'ingredients' => ['3 Large Egg Whites', '1 Whole Egg', '1 cup Fresh Spinach', '30g Low-Fat Feta Cheese', '1 tsp Olive Oil'],
                        'instructions' => 'Whisk eggs, pour into hot pan with olive oil. Add spinach and feta, fold and cook until set.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Spiced Chickpea Buddha Bowl',
                        'calories' => 450,
                        'macros' => ['carbs' => '48g', 'protein' => '18g', 'fat' => '14g'],
                        'ingredients' => ['1 cup Roasted Chickpeas', '1/2 cup Cooked Quinoa', '1 cup Steamed Kale', '1/2 Avocado, sliced', '1 tbsp Tahini sauce'],
                        'instructions' => 'Assemble cooked quinoa, roasted chickpeas, kale, and avocado in a bowl. Drizzle with sesame tahini.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Teriyaki Glazed Tempeh Bowl',
                        'calories' => 480,
                        'macros' => ['carbs' => '32g', 'protein' => '30g', 'fat' => '18g'],
                        'ingredients' => ['150g Organic Tempeh', '2 cups Sautéed Mixed Peppers & Broccoli', '1/2 cup Brown Rice', '1 tbsp Teriyaki glaze'],
                        'instructions' => 'Cube tempeh and pan-sear with teriyaki. Serve over warm brown rice and broccoli florets.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Cottage Cheese & Berries',
                        'calories' => 180,
                        'macros' => ['carbs' => '12g', 'protein' => '16g', 'fat' => '4g'],
                        'ingredients' => ['150g Low-Fat Cottage Cheese', '1/2 cup Raspberries', '1/2 tsp Flax seeds'],
                        'instructions' => 'Top creamy cottage cheese with raspberries and a dash of ground flax seeds.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'stress_relief' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Almond Butter & Banana Oatmeal',
                        'calories' => 380,
                        'macros' => ['carbs' => '52g', 'protein' => '10g', 'fat' => '14g'],
                        'ingredients' => ['1/2 cup Rolled Oats', '1 tbsp Smooth Almond Butter', '1/2 Banana, sliced', '1/2 cup Oat milk', 'Pinch of Cinnamon'],
                        'instructions' => 'Boil oats in oat milk. Top with warm banana slices, almond butter, and ground cinnamon.',
                        'image' => 'https://images.unsplash.com/photo-1517881917430-e70dfb3610aa?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Soothing Lentil & Spinach Soup',
                        'calories' => 390,
                        'macros' => ['carbs' => '44g', 'protein' => '18g', 'fat' => '10g'],
                        'ingredients' => ['1.5 cups Brown Lentils, cooked', '2 cups Fresh Spinach', '1/2 Carrot, chopped', '1 slice Whole Wheat Sourdough'],
                        'instructions' => 'Simmer lentils, carrots, and spinach in vegetable broth. Serve warm with toasted sourdough.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Creamy Paneer & Spinach Curry',
                        'calories' => 510,
                        'macros' => ['carbs' => '18g', 'protein' => '24g', 'fat' => '32g'],
                        'ingredients' => ['120g Paneer cheese, cubed', '3 cups Pureed Spinach (Palak)', '1/2 cup Basmati Rice', '1 tbsp Ghee & Garam Masala'],
                        'instructions' => 'Sauté paneer cubes. Simmer pureed spinach in spices and ghee, fold in paneer, serve with rice.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Fresh Pear & Roasted Walnuts',
                        'calories' => 160,
                        'macros' => ['carbs' => '16g', 'protein' => '3g', 'fat' => '9g'],
                        'ingredients' => ['1 Fresh Pear', '8 Walnut halves'],
                        'instructions' => 'Slice the pear and serve with crunchy walnut halves.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'flexibility' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Alkaline Green Smoothie Bowl',
                        'calories' => 330,
                        'macros' => ['carbs' => '38g', 'protein' => '12g', 'fat' => '10g'],
                        'ingredients' => ['1 cup Baby Spinach', '1/2 Avocado', '1 cup Unsweetened Soy Milk', '1 scoop Plant Protein', '1 tbsp Sunflower seeds'],
                        'instructions' => 'Blend spinach, avocado, soy milk, and protein powder. Pour into a bowl and top with sunflower seeds.',
                        'image' => 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Tempeh & Beet Root Salad',
                        'calories' => 430,
                        'macros' => ['carbs' => '24g', 'protein' => '22g', 'fat' => '16g'],
                        'ingredients' => ['120g Steamed Tempeh', '1 cup Cooked Beetroot slices', '2 cups Rocket greens', '30g Goat Cheese', '1 tbsp Vinaigrette'],
                        'instructions' => 'Lay rocket, sliced beets, tempeh, and goat cheese on a plate. Drizzle with vinaigrette.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Lentil & Sweet Potato Shepherd Pie',
                        'calories' => 490,
                        'macros' => ['carbs' => '54g', 'protein' => '20g', 'fat' => '12g'],
                        'ingredients' => ['1 cup Stewed Lentils & Peas', '1 cup Sweet Potato mash', '1 tsp Olive oil', 'Seasoning spices'],
                        'instructions' => 'Place stewed lentils in a baking dish, cover with mashed sweet potatoes, and bake at 375F for 20 mins.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Almond Milk Chia Treat',
                        'calories' => 170,
                        'macros' => ['carbs' => '14g', 'protein' => '5g', 'fat' => '8g'],
                        'ingredients' => ['2 tbsp Chia seeds', '1 cup Almond Milk', '1/2 cup Strawberries'],
                        'instructions' => 'Mix chia seeds and almond milk, let thicken, top with fresh cut strawberries.',
                        'image' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=500&q=80&auto=format&fit=crop'
                    ]
                ]
            ],
            'vegan' => [
                'label' => '100% Plant-Based Plan',
                'weight_loss' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Tofu Scramble & Spinach',
                        'calories' => 310,
                        'macros' => ['carbs' => '12g', 'protein' => '24g', 'fat' => '15g'],
                        'ingredients' => ['150g Firm Tofu, crumbled', '1 cup Baby Spinach', '1/4 tsp Turmeric & Black salt', '1 slice Whole Grain Toast'],
                        'instructions' => 'Sauté crumbled tofu in turmeric and black salt. Add spinach until wilted. Serve with dry toast.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Quinoa Hummus Salad Bowl',
                        'calories' => 420,
                        'macros' => ['carbs' => '46g', 'protein' => '14g', 'fat' => '15g'],
                        'ingredients' => ['1 cup Cooked Quinoa', '2 tbsp Creamy Hummus', '1 cup Cucumber cubes', '1 cup Shredded Kale', '1 tbsp Pumpkin seeds'],
                        'instructions' => 'Mix quinoa, cucumber, and kale in a bowl. Top with raw pumpkin seeds and dollops of hummus.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Seared Tempeh & Broccoli',
                        'calories' => 460,
                        'macros' => ['carbs' => '28g', 'protein' => '32g', 'fat' => '18g'],
                        'ingredients' => ['150g Organic Tempeh', '2 cups Steamed Broccoli', '1/2 cup Cooked Brown Rice', '1 tbsp Tamari Soy Sauce'],
                        'instructions' => 'Sauté tempeh slices in tamari. Serve with warm brown rice and freshly steamed broccoli.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Salted Roasted Edamame',
                        'calories' => 150,
                        'macros' => ['carbs' => '10g', 'protein' => '14g', 'fat' => '5g'],
                        'ingredients' => ['1 cup Edamame in pods', 'Coarse sea salt'],
                        'instructions' => 'Steam edamame pods for 5 mins, drain, and sprinkle with sea salt.',
                        'image' => 'https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'stress_relief' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Maple Pecan Oatmeal Bowl',
                        'calories' => 360,
                        'macros' => ['carbs' => '48g', 'protein' => '8g', 'fat' => '12g'],
                        'ingredients' => ['1/2 cup Rolled Oats', '1 tbsp Pure Maple Syrup', '10 Pecan halves', '1 cup Unsweetened Coconut Milk', 'Pinch of Nutmeg'],
                        'instructions' => 'Simmer oats in coconut milk, stir in maple syrup and nutmeg, top with roasted pecans.',
                        'image' => 'https://images.unsplash.com/photo-1517881917430-e70dfb3610aa?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Creamy Sweet Potato & Lentil Dal',
                        'calories' => 420,
                        'macros' => ['carbs' => '54g', 'protein' => '16g', 'fat' => '11g'],
                        'ingredients' => ['1 cup Red Lentils, stewed', '1/2 cup Sweet Potato cubes', '1/2 cup Coconut Milk, light', '1 tsp Turmeric & Ginger'],
                        'instructions' => 'Simmer sweet potatoes and lentils in spiced coconut milk broth until fully tender.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Baked Tofu & Avocado Buddha Bowl',
                        'calories' => 490,
                        'macros' => ['carbs' => '32g', 'protein' => '24g', 'fat' => '22g'],
                        'ingredients' => ['120g Baked Tofu cubes', '1/2 Avocado', '1 cup Shredded Purple Cabbage', '1 cup Steamed Kale', '1 tbsp Tahini Dressing'],
                        'instructions' => 'Assemble baked tofu, avocado halves, cabbage, and kale in a bowl. Drizzle with rich tahini.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Raw Walnuts & Pumpkin Seeds',
                        'calories' => 180,
                        'macros' => ['carbs' => '6g', 'protein' => '6g', 'fat' => '14g'],
                        'ingredients' => ['15g Raw Walnut halves', '1 tbsp Pumpkin seeds'],
                        'instructions' => 'Enjoy walnuts and pumpkin seeds slowly to absorb calming magnesium and Omega-3s.',
                        'image' => 'https://images.unsplash.com/photo-1508061253366-f7da158b6d96?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'flexibility' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Tropical Green Coconut Smoothie Bowl',
                        'calories' => 310,
                        'macros' => ['carbs' => '36g', 'protein' => '10g', 'fat' => '11g'],
                        'ingredients' => ['1 cup Fresh Spinach', '1/2 cup Frozen Mango', '1/2 cup Coconut water', '1 scoop Plant Protein', '1 tbsp Chia seeds'],
                        'instructions' => 'Blend spinach, mango, coconut water, and plant protein. Pour and top with raw chia seeds.',
                        'image' => 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Chickpea Salad Veggie Hummus Wrap',
                        'calories' => 410,
                        'macros' => ['carbs' => '48g', 'protein' => '12g', 'fat' => '12g'],
                        'ingredients' => ['1 Spinach Wrap tortilla', '2 tbsp Classic Hummus', '1/2 cup Cooked Chickpeas', '1/2 cup Shredded Carrots', 'Cucumber slices'],
                        'instructions' => 'Mash chickpeas slightly with hummus, fold onto Spinach wrap with carrots and cucumbers, roll tight.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Lentil Sweet Potato Shepherd Pie',
                        'calories' => 480,
                        'macros' => ['carbs' => '54g', 'protein' => '18g', 'fat' => '10g'],
                        'ingredients' => ['1 cup Stewed Lentils & Carrots', '1 cup Sweet Potato mash', '1 tsp Coconut Oil', 'Rosemary spices'],
                        'instructions' => 'Place stewed lentils in a baking dish, cover with mashed sweet potatoes, and bake at 375F for 20 mins.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Magnesium Rich Pumpkin Seeds & Dates',
                        'calories' => 170,
                        'macros' => ['carbs' => '22g', 'protein' => '5g', 'fat' => '6g'],
                        'ingredients' => ['2 tbsp Pumpkin Seeds', '2 Medjool Dates'],
                        'instructions' => 'Snack on Medjool dates stuffed with raw pumpkin seeds for joint and muscle recovery.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ]
                ]
            ],
            'keto' => [
                'label' => 'Keto / Low-Carb Recovery Plan',
                'weight_loss' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Avocado Omelette with Crispy Bacon',
                        'calories' => 450,
                        'macros' => ['carbs' => '4g', 'protein' => '26g', 'fat' => '36g'],
                        'ingredients' => ['3 Large Eggs', '1/2 ripe Avocado', '2 slices Bacon', '1 tbsp Butter'],
                        'instructions' => 'Cook bacon till crisp. Fry eggs in butter, wrap around avocado slices and serve with bacon.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Keto Caesar Chicken Salad Bowl',
                        'calories' => 520,
                        'macros' => ['carbs' => '5g', 'protein' => '38g', 'fat' => '38g'],
                        'ingredients' => ['150g Grilled Chicken Breast', '3 cups Mixed Greens', '30g Parmesan cheese', '2 tbsp Creamy Caesar dressing'],
                        'instructions' => 'Toss chicken breast slices with mixed greens, shaved parmesan, and olive-oil based Caesar dressing.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Baked Herb Salmon & Broccoli florets',
                        'calories' => 550,
                        'macros' => ['carbs' => '6g', 'protein' => '42g', 'fat' => '38g'],
                        'ingredients' => ['150g Wild Salmon Fillet', '2 cups Broccoli florets', '2 tbsp Olive Oil', '1 tbsp Grass-fed Butter'],
                        'instructions' => 'Bake salmon and broccoli tossed in olive oil at 400F for 12 mins. Serve topped with melted butter.',
                        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Roasted Pecans & Almonds',
                        'calories' => 220,
                        'macros' => ['carbs' => '3g', 'protein' => '4g', 'fat' => '22g'],
                        'ingredients' => ['20g Raw Pecans', '10g Raw Almonds'],
                        'instructions' => 'Toss raw pecans and almonds together for a high-fat, high-satiety low-carb snack.',
                        'image' => 'https://images.unsplash.com/photo-1508061253366-f7da158b6d96?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'stress_relief' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Keto Coffee & Scrambled Eggs with Feta',
                        'calories' => 410,
                        'macros' => ['carbs' => '3g', 'protein' => '22g', 'fat' => '34g'],
                        'ingredients' => ['3 Large Eggs', '40g Feta Cheese', '1 tbsp Butter', '1 cup Black Coffee with 1 tsp MCT oil'],
                        'instructions' => 'Scramble eggs in butter, fold in crumbled feta cheese. Blend hot black coffee with MCT oil.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Avocado Tuna Salad Cups',
                        'calories' => 440,
                        'macros' => ['carbs' => '4g', 'protein' => '32g', 'fat' => '32g'],
                        'ingredients' => ['1 can Tuna in oil', '2 tbsp Real Mayonnaise', '1 Ripe Avocado, halved', 'Cucumber slices'],
                        'instructions' => 'Drain tuna, mix with mayonnaise and black pepper. Stuff into scooped avocado halves, serve with cucumber.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Keto Steak & Sautéed Spinach',
                        'calories' => 580,
                        'macros' => ['carbs' => '5g', 'protein' => '44g', 'fat' => '42g'],
                        'ingredients' => ['150g Sirloin Steak', '3 cups Baby Spinach', '1 tbsp Garlic butter', '1 tbsp Olive Oil'],
                        'instructions' => 'Sear steak in butter to desired doneness. Sauté spinach in garlic and olive oil in the same pan.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Creamy Macadamia Nuts',
                        'calories' => 200,
                        'macros' => ['carbs' => '3g', 'protein' => '2g', 'fat' => '21g'],
                        'ingredients' => ['30g Macadamia Nuts'],
                        'instructions' => 'Enjoy magnesium-packed raw macadamia nuts slow-chewed to soothe stress hormones.',
                        'image' => 'https://images.unsplash.com/photo-1508061253366-f7da158b6d96?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'flexibility' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'Keto Almond Chia Smoothie',
                        'calories' => 380,
                        'macros' => ['carbs' => '5g', 'protein' => '12g', 'fat' => '34g'],
                        'ingredients' => ['1 cup Sugar-Free Almond milk', '2 tbsp Heavy Cream', '1 tbsp Almond Butter', '1 tbsp Chia seeds', '1 scoop Collagen Protein'],
                        'instructions' => 'Blend almond milk, heavy cream, almond butter, chia seeds, and collagen powder until smooth.',
                        'image' => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Steamed Chicken with Butter Broccolini',
                        'calories' => 460,
                        'macros' => ['carbs' => '6g', 'protein' => '38g', 'fat' => '30g'],
                        'ingredients' => ['150g Chicken thighs', '1.5 cups Broccolini', '2 tbsp Butter', 'Garlic cloves'],
                        'instructions' => 'Steam chicken thighs. Sauté broccolini with sliced garlic and butter. Toss together.',
                        'image' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Baked Salmon & Asparagus with Hollandaise',
                        'calories' => 590,
                        'macros' => ['carbs' => '5g', 'protein' => '42g', 'fat' => '44g'],
                        'ingredients' => ['150g Wild Salmon', '2 cups Asparagus', '2 tbsp Hollandaise sauce', '1 tbsp Olive Oil'],
                        'instructions' => 'Bake salmon and asparagus in olive oil at 400F for 12 mins. Drizzle warm Hollandaise sauce over.',
                        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Salted Avocado Slices',
                        'calories' => 160,
                        'macros' => ['carbs' => '3g', 'protein' => '2g', 'fat' => '15g'],
                        'ingredients' => ['1/2 Avocado', 'Pink Himalayan salt'],
                        'instructions' => 'Slice half avocado, sprinkle with Himalayan salt to maintain potassium levels.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&q=80&auto=format&fit=crop'
                    ]
                ]
            ],
            'high_protein' => [
                'label' => 'High-Protein Performance Plan',
                'weight_loss' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'High-Protein Omelette & Turkey Bacon',
                        'calories' => 380,
                        'macros' => ['carbs' => '8g', 'protein' => '38g', 'fat' => '16g'],
                        'ingredients' => ['4 Large Egg Whites', '1 Whole Egg', '2 slices Lean Turkey Bacon', '1 cup Spinach', '30g Low-Fat Cheddar'],
                        'instructions' => 'Scramble eggs with spinach and turkey bacon bits. Fold in cheddar and cook.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Grilled Chicken Salad with Egg',
                        'calories' => 480,
                        'macros' => ['carbs' => '10g', 'protein' => '48g', 'fat' => '18g'],
                        'ingredients' => ['150g Grilled Chicken Breast', '1 Hard Boiled Egg', '3 cups Mixed Lettuce', '1/2 Cucumber', '1 tbsp Light vinaigrette'],
                        'instructions' => 'Slice chicken breast and boiled egg. Toss with greens, cucumbers, and a splash of vinaigrette.',
                        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Lemon Pepper Tilapia & Rice',
                        'calories' => 450,
                        'macros' => ['carbs' => '32g', 'protein' => '42g', 'fat' => '10g'],
                        'ingredients' => ['180g Tilapia or Cod fillet', '1/2 cup cooked Basmati Rice', '2 cups Steamed Green Beans', 'Lemon slices'],
                        'instructions' => 'Pan-sear fish with lemon pepper seasoning. Serve with warm rice and steamed green beans.',
                        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Performance Whey Shake & Almonds',
                        'calories' => 220,
                        'macros' => ['carbs' => '6g', 'protein' => '26g', 'fat' => '10g'],
                        'ingredients' => ['1 scoop Whey Protein isolate', '1 cup water', '10 Raw Almonds'],
                        'instructions' => 'Blend whey protein with water. Enjoy alongside crunchy raw almonds.',
                        'image' => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'stress_relief' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'High-Protein Greek Yogurt & Almonds',
                        'calories' => 340,
                        'macros' => ['carbs' => '15g', 'protein' => '28g', 'fat' => '12g'],
                        'ingredients' => ['200g Greek Yogurt 0%', '1 scoop Vanilla Whey Protein', '12 Almonds', '1/2 cup Strawberries'],
                        'instructions' => 'Fold vanilla protein into Greek yogurt until thick and smooth. Top with strawberries and almonds.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'Turkey Breast & Spinach Quinoa Bowl',
                        'calories' => 450,
                        'macros' => ['carbs' => '32g', 'protein' => '40g', 'fat' => '12g'],
                        'ingredients' => ['150g Sliced Turkey Breast', '1/2 cup Cooked Quinoa', '2 cups Sautéed Spinach', '1 tbsp Sunflower seeds'],
                        'instructions' => 'Toss warm quinoa with turkey slices, sautéed garlic spinach, and sunflower seeds.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'High-Protein Grilled Tofu & Shrimp Bowl',
                        'calories' => 520,
                        'macros' => ['carbs' => '22g', 'protein' => '45g', 'fat' => '18g'],
                        'ingredients' => ['100g Grilled Shrimp', '100g Grilled Tofu', '1 cup Steamed Broccoli', '1/2 cup Jasmine Rice'],
                        'instructions' => 'Arrange seasoned shrimp and tofu on warm jasmine rice and steamed broccoli florets.',
                        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Boiled Eggs & Pumpkin Seeds',
                        'calories' => 210,
                        'macros' => ['carbs' => '4g', 'protein' => '18g', 'fat' => '14g'],
                        'ingredients' => ['2 Hard Boiled Eggs', '1 tbsp Pumpkin seeds'],
                        'instructions' => 'Slice boiled eggs, sprinkle with salt and pepper, enjoy with raw pumpkin seeds.',
                        'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&q=80&auto=format&fit=crop'
                    ]
                ],
                'flexibility' => [
                    [
                        'type' => 'Breakfast',
                        'name' => 'High-Protein Chia Berry Pudding Bowl',
                        'calories' => 350,
                        'macros' => ['carbs' => '24g', 'protein' => '22g', 'fat' => '12g'],
                        'ingredients' => ['3 tbsp Chia seeds', '1 scoop Plant Protein', '1 cup Almond Milk', '1/2 cup Raspberries'],
                        'instructions' => 'Whisk protein powder and almond milk, stir in chia seeds. Chill till thick, top with fresh raspberries.',
                        'image' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Lunch',
                        'name' => 'High-Protein Tempeh Salad Wrap',
                        'calories' => 440,
                        'macros' => ['carbs' => '32g', 'protein' => '28g', 'fat' => '18g'],
                        'ingredients' => ['1 Spinach Tortilla wrap', '150g Organic Tempeh', '1 cup Salad greens', '1 tbsp Hummus'],
                        'instructions' => 'Sauté tempeh, spread hummus on tortilla, layer tempeh and greens, roll and slice.',
                        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=500&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Dinner',
                        'name' => 'Beef Sirloin & Garlic Broccoli Stir-Fry',
                        'calories' => 530,
                        'macros' => ['carbs' => '14g', 'protein' => '44g', 'fat' => '22g'],
                        'ingredients' => ['150g Lean Sirloin beef', '2 cups Broccoli florets', '1 tbsp Garlic ginger paste', '1 tbsp Soy sauce', '1/2 cup Jasmine Rice'],
                        'instructions' => 'Stir-fry beef strips and broccoli in ginger soy glaze. Serve over jasmine rice.',
                        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&q=80&auto=format&fit=crop'
                    ],
                    [
                        'type' => 'Snack',
                        'name' => 'Cottage Cheese & Pumpkin Seeds',
                        'calories' => 190,
                        'macros' => ['carbs' => '8g', 'protein' => '20g', 'fat' => '8g'],
                        'ingredients' => ['150g Cottage Cheese 2%', '1.5 tbsp Raw Pumpkin Seeds'],
                        'instructions' => 'Enjoy fresh cottage cheese sprinkled with pumpkin seeds for structural muscle repair.',
                        'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80&auto=format&fit=crop'
                    ]
                ]
            ]
        ];

        $dietaryPreference = $preference->dietary_preference ?? 'balanced';
        $userDietPlan = $dietPlans[$dietaryPreference] ?? $dietPlans['balanced'];
        $dietMeals = $userDietPlan[$preference->goal] ?? $userDietPlan['stress_relief'];
        
        $dietLabels = [
            'balanced' => 'Balanced Nutrition Plan',
            'vegetarian' => 'Vegetarian Healing Plan',
            'vegan' => '100% Plant-Based Plan',
            'keto' => 'Keto / Low-Carb Recovery Plan',
            'high_protein' => 'High-Protein Performance Plan',
        ];
        $dietLabel = $dietLabels[$dietaryPreference] ?? 'Balanced Nutrition Plan';

        return view('plan', compact(
            'yoga', 
            'meditation', 
            'preference', 
            'streak', 
            'planVideoRecommendations', 
            'dietMeals', 
            'dietLabel'
        ));
    }
}
