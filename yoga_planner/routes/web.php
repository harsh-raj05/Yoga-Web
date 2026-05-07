<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PreferenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\Admin\YogaController;
use App\Http\Controllers\Admin\MeditationController;
use App\Models\Preference;
use App\Models\Progress;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    $userId = auth()->id();
    $preference = Preference::where('user_id', $userId)->first();

    $completedDates = Progress::where('user_id', $userId)
        ->where('completed', true)
        ->orderBy('date')
        ->pluck('date')
        ->map(fn ($date) => (string) $date)
        ->unique()
        ->values();

    $dateLookup = $completedDates->flip();
    $today = now()->startOfDay();

    $streakAnchor = null;

    if ($dateLookup->has($today->toDateString())) {
        $streakAnchor = $today->copy();
    } elseif ($dateLookup->has($today->copy()->subDay()->toDateString())) {
        $streakAnchor = $today->copy()->subDay();
    }

    $currentStreak = 0;

    if ($streakAnchor) {
        while ($dateLookup->has($streakAnchor->copy()->subDays($currentStreak)->toDateString())) {
            $currentStreak++;
        }
    }

    $longestStreak = 0;
    $runningStreak = 0;
    $previousDate = null;

    foreach ($completedDates as $date) {
        $currentDate = \Illuminate\Support\Carbon::parse($date);

        if ($previousDate && $currentDate->diffInDays($previousDate) === 1) {
            $runningStreak++;
        } else {
            $runningStreak = 1;
        }

        $longestStreak = max($longestStreak, $runningStreak);
        $previousDate = $currentDate;
    }

    $completedSessions = $completedDates->count();
    $availableTime = $preference?->available_time ?? 0;
    $minutesPracticed = $completedSessions * $availableTime;

    $countCompletedDays = function (int $startOffset, int $length) use ($dateLookup, $today) {
        return collect(range($startOffset, $startOffset + $length - 1))
            ->filter(fn ($offset) => $dateLookup->has($today->copy()->subDays($offset)->toDateString()))
            ->count();
    };

    $last7Count = $countCompletedDays(0, 7);
    $prev7Count = $countCompletedDays(7, 7);
    $last30Count = $countCompletedDays(0, 30);
    $prev30Count = $countCompletedDays(30, 30);

    $weeklyConsistency = (int) round(($last7Count / 7) * 100);
    $monthlyMomentum = (int) round(($last30Count / 30) * 100);
    $habitStrength = min(100, (int) round((min($currentStreak, 14) / 14) * 100));
    $practiceScore = (int) round(($weeklyConsistency * 0.45) + ($monthlyMomentum * 0.35) + ($habitStrength * 0.20));

    $formatMinutes = function (int $minutes) {
        if ($minutes <= 0) {
            return '0m';
        }

        $hours = intdiv($minutes, 60);
        $remainingMinutes = $minutes % 60;

        if ($hours === 0) {
            return $remainingMinutes . 'm';
        }

        if ($remainingMinutes === 0) {
            return $hours . 'h';
        }

        return $hours . 'h ' . $remainingMinutes . 'm';
    };

    $weeklyChangeLabel = match (true) {
        $last7Count > $prev7Count => 'Up ' . ($last7Count - $prev7Count) . ' session(s) vs last week',
        $last7Count < $prev7Count => 'Down ' . ($prev7Count - $last7Count) . ' session(s) vs last week',
        default => 'Steady vs last week',
    };

    $monthlyChangeLabel = match (true) {
        $last30Count > $prev30Count => 'Up ' . ($last30Count - $prev30Count) . ' session(s) this month',
        $last30Count < $prev30Count => 'Down ' . ($prev30Count - $last30Count) . ' session(s) this month',
        default => 'Steady this month',
    };

    $scoreLabel = match (true) {
        $practiceScore >= 80 => 'Strong routine this month',
        $practiceScore >= 55 => 'Good momentum building',
        $practiceScore >= 25 => 'Consistency is growing',
        default => 'Start with one completed session',
    };

    $dashboardStats = [
        'streak_value' => $currentStreak,
        'streak_sub' => $currentStreak === 1 ? 'consecutive day' : 'consecutive days',
        'streak_badge' => $completedSessions === 0
            ? 'No completed sessions yet'
            : ($currentStreak === $longestStreak ? 'Matching your best streak' : 'Best streak: ' . $longestStreak . ' days'),
        'sessions_value' => $completedSessions,
        'sessions_sub' => 'completed practice check-ins',
        'sessions_badge' => $weeklyChangeLabel,
        'minutes_value' => $formatMinutes($minutesPracticed),
        'minutes_sub' => $availableTime > 0 ? 'estimated from your saved daily practice time' : 'set preferences to track estimated minutes',
        'minutes_badge' => $monthlyChangeLabel,
        'score_value' => $practiceScore . '%',
        'score_sub' => 'activity-based practice score',
        'score_badge' => $scoreLabel,
    ];

    $activityMetrics = [
        [
            'name' => 'Weekly Consistency',
            'pct' => $weeklyConsistency,
            'meta' => $last7Count . ' of 7 days completed',
            'bar_class' => '',
        ],
        [
            'name' => 'Monthly Momentum',
            'pct' => $monthlyMomentum,
            'meta' => $last30Count . ' of 30 days completed',
            'bar_class' => 'clay',
        ],
        [
            'name' => 'Habit Strength',
            'pct' => $habitStrength,
            'meta' => 'Current streak ' . $currentStreak . ', best ' . $longestStreak,
            'bar_class' => 'mid',
        ],
    ];

    $videoRecommendations = null;

    if ($preference) {
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
                'subtitle' => 'A more energetic yoga session to support movement consistency and full-body engagement.',
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
                'subtitle' => 'A short guided meditation to help support discipline, consistency, and a lighter mental reset.',
                'youtube_id' => '-9KLB2HI9BI',
                'duration' => '10 min',
            ],
            'stress_relief' => [
                'title' => 'Stress Relief Meditation',
                'subtitle' => 'A calming guided meditation to settle anxious energy and make the practice feel more restorative.',
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

        $videoRecommendations = [
            'goal_label' => $goalLabels[$preference->goal] ?? ucfirst(str_replace('_', ' ', $preference->goal)),
            'level_label' => $levelLabels[$preference->experience_level] ?? ucfirst($preference->experience_level),
            'yoga' => $yogaVideos[$preference->goal] ?? $yogaVideos['stress_relief'],
            'meditation' => $meditationVideos[$preference->goal] ?? $meditationVideos['stress_relief'],
        ];
    }

    return view('dashboard', compact('preference', 'videoRecommendations', 'dashboardStats', 'activityMetrics'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 👇 ADD THIS PART
    Route::get('/preferences', [PreferenceController::class, 'create'])->name('preferences.create');
    Route::post('/preferences', [PreferenceController::class, 'store'])->name('preferences.store');
    
    Route::get('/plan', [PlannerController::class, 'index'])->name('plan');
    Route::post('/complete', [ProgressController::class, 'store'])->name('complete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/yoga', [YogaController::class, 'index'])->name('admin.yoga');
    Route::get('/admin/yoga/create', [YogaController::class, 'create'])->name('admin.yoga.create');
    Route::post('/admin/yoga', [YogaController::class, 'store'])->name('admin.yoga.store');
    Route::delete('/admin/yoga/{id}', [YogaController::class, 'destroy'])->name('admin.yoga.delete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/meditation', [MeditationController::class, 'index'])->name('admin.meditation');
    Route::get('/admin/meditation/create', [MeditationController::class, 'create'])->name('admin.meditation.create');
    Route::post('/admin/meditation', [MeditationController::class, 'store'])->name('admin.meditation.store');
    Route::delete('/admin/meditation/{id}', [MeditationController::class, 'destroy'])->name('admin.meditation.delete');
});




use App\Models\User;

Route::get('/make-admin', function () {
    $user = User::where('email', 'rajharshsingh2005@gmail.com')->first();

    if ($user) {
        $user->is_admin = 1;
        $user->save();

        return 'Admin granted successfully';
    }

    return 'User not found';
});

require __DIR__.'/auth.php';
