<x-app-layout>
    @include('admin.partials.theme')

    @php
        $typeLabels = [
            'weight_loss' => 'Weight Loss',
            'stress_relief' => 'Stress Relief',
            'flexibility' => 'Flexibility',
        ];

        $totalMinutes = $meditation->sum('duration');
        $uniqueTypes = $meditation->pluck('type')->filter()->unique()->count();
    @endphp

    <div class="admin-page">
        <div class="admin-bg" style="--admin-bg-image: url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1800&q=80&auto=format&fit=crop');"></div>

        <div class="admin-wrap">
            <section class="admin-shell">
                <span class="admin-kicker">Admin meditation library</span>
                <h1 class="admin-title">Manage meditation sessions with a cleaner, more <em>focused</em> admin view.</h1>
                <p class="admin-copy">
                    Keep your meditation catalog aligned with the planner so users receive complementary sessions that support the same goal as their yoga practice.
                </p>

                <div class="admin-toolbar">
                    <div class="admin-actions">
                        <a href="{{ route('admin.meditation.create') }}" class="admin-button-primary">Add Meditation Session</a>
                        <a href="{{ route('dashboard') }}" class="admin-button-secondary">Back to Dashboard</a>
                    </div>
                </div>

                <div class="admin-stats">
                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Total sessions</div>
                        <div class="admin-stat-value">{{ $meditation->count() }}</div>
                        <div class="admin-stat-sub">Meditation records currently available to the planner.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Minutes in library</div>
                        <div class="admin-stat-value">{{ $totalMinutes }}</div>
                        <div class="admin-stat-sub">Combined duration across your meditation content set.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Goal alignment</div>
                        <div class="admin-stat-value">{{ $uniqueTypes }}</div>
                        <div class="admin-stat-sub">Distinct planner goals represented in meditation types.</div>
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
                        <h2 class="admin-card-title">Meditation session index</h2>
                        <p class="admin-card-copy">
                            These sessions are matched by planner goal, so the type value should stay consistent with the user goals used across the app.
                        </p>
                    </div>

                    <span class="admin-pill">Stillness library</span>
                </div>

                <div class="admin-list">
                    @forelse($meditation as $session)
                        <article class="admin-item">
                            <div>
                                <h3 class="admin-item-title">{{ $session->name }}</h3>

                                <div class="admin-meta-row">
                                    <span class="admin-badge">{{ $typeLabels[$session->type] ?? ucfirst(str_replace('_', ' ', $session->type)) }}</span>
                                    <span class="admin-badge">{{ $session->duration }} min</span>
                                </div>

                                @if($session->description)
                                    <p class="admin-item-copy">{{ $session->description }}</p>
                                @else
                                    <p class="admin-item-copy">
                                        No description has been added yet. A short note about breathing style, focus, or intended result makes the catalog easier to maintain.
                                    </p>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('admin.meditation.delete', $session->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-delete">Delete</button>
                            </form>
                        </article>
                    @empty
                        <div class="admin-empty">
                            No meditation sessions have been added yet. Add a few goal-aligned options so each personalized plan can include a meaningful mindfulness component.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
