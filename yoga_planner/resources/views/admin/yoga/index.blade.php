<x-app-layout>
    @include('admin.partials.theme')

    @php
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

        $totalMinutes = $yoga->sum('duration');
        $uniqueGoals = $yoga->pluck('goal')->filter()->unique()->count();
    @endphp

    <div class="admin-page">
        <div class="admin-bg" style="--admin-bg-image: url('https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=1800&q=80&auto=format&fit=crop');"></div>

        <div class="admin-wrap">
            <section class="admin-shell">
                <span class="admin-kicker">Admin yoga library</span>
                <h1 class="admin-title">Curate yoga sessions with a calmer, more <em>professional</em> workspace.</h1>
                <p class="admin-copy">
                    Review your yoga session catalog, keep goal coverage balanced, and manage what appears inside personalized user plans.
                </p>

                <div class="admin-toolbar">
                    <div class="admin-actions">
                        <a href="{{ route('admin.yoga.create') }}" class="admin-button-primary">Add Yoga Session</a>
                        <a href="{{ route('dashboard') }}" class="admin-button-secondary">Back to Dashboard</a>
                    </div>
                </div>

                <div class="admin-stats">
                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Total sessions</div>
                        <div class="admin-stat-value">{{ $yoga->count() }}</div>
                        <div class="admin-stat-sub">Yoga records currently available to the planner.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Minutes in library</div>
                        <div class="admin-stat-value">{{ $totalMinutes }}</div>
                        <div class="admin-stat-sub">Combined duration across your yoga content set.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Goal coverage</div>
                        <div class="admin-stat-value">{{ $uniqueGoals }}</div>
                        <div class="admin-stat-sub">Distinct user goals represented in yoga sessions.</div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="admin-success">
                        {{ session('success') }}
                    </div>
                @endif
            </section>

            <section class="admin-card" style="margin-top: 1.5rem;">
                <div class="admin-form-head">
                    <div>
                        <h2 class="admin-card-title">Yoga session index</h2>
                        <p class="admin-card-copy">
                            Each session below can be surfaced in user plans when its goal and level match a person's preferences.
                        </p>
                    </div>

                    <span class="admin-pill">Movement library</span>
                </div>

                <div class="admin-list">
                    @forelse($yoga as $session)
                        <article class="admin-item">
                            <div>
                                <h3 class="admin-item-title">{{ $session->name }}</h3>

                                <div class="admin-meta-row">
                                    <span class="admin-badge">{{ $goalLabels[$session->goal] ?? ucfirst(str_replace('_', ' ', $session->goal)) }}</span>
                                    <span class="admin-badge">{{ $levelLabels[$session->level] ?? ucfirst($session->level) }}</span>
                                    <span class="admin-badge">{{ $session->duration }} min</span>
                                </div>

                                @if($session->description)
                                    <p class="admin-item-copy">{{ $session->description }}</p>
                                @else
                                    <p class="admin-item-copy">
                                        No description has been added yet. Consider including focus, intensity, or session intent so the content library is easier to manage over time.
                                    </p>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('admin.yoga.delete', $session->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-delete">Delete</button>
                            </form>
                        </article>
                    @empty
                        <div class="admin-empty">
                            No yoga sessions have been added yet. Start by creating a few beginner and intermediate sessions across your main goals so the planner has useful coverage.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
