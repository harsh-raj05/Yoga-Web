<x-app-layout>
    @include('admin.partials.theme')

    @php
        $goal = old('goal', 'stress_relief');
        $level = old('level', 'beginner');
    @endphp

    <div class="admin-page">
        <div class="admin-bg" style="--admin-bg-image: url('https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=1800&q=80&auto=format&fit=crop');"></div>

        <div class="admin-wrap">
            <section class="admin-shell">
                <span class="admin-kicker">Admin yoga authoring</span>
                <h1 class="admin-title">Add a yoga session that fits the app’s <em>planning system</em>.</h1>
                <p class="admin-copy">
                    Use clear goal and level tags so the planner can match this session to the right user. Short, realistic durations make the generated plans feel more trustworthy.
                </p>

                <div class="admin-stats">
                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Best for</div>
                        <div class="admin-stat-value">Clarity</div>
                        <div class="admin-stat-sub">Name sessions in a way that makes their purpose obvious at a glance.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Match quality</div>
                        <div class="admin-stat-value">Goal + Level</div>
                        <div class="admin-stat-sub">These two fields directly control whether the planner can surface the session.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Keep it usable</div>
                        <div class="admin-stat-value">Realistic time</div>
                        <div class="admin-stat-sub">Choose durations users can actually complete within their available time.</div>
                    </div>
                </div>
            </section>

            <section class="admin-card" style="margin-top: 1.5rem;">
                <div class="admin-form-head">
                    <div>
                        <h2 class="admin-card-title">Create yoga session</h2>
                        <p class="admin-card-copy">
                            Fill in the core details below. Descriptions are optional, but they make the admin catalog easier to review later.
                        </p>
                    </div>

                    <span class="admin-pill">New record</span>
                </div>

                @if ($errors->any())
                    <div class="admin-empty" style="background: rgba(190, 57, 44, 0.08); color: #8e3328; border-color: rgba(190, 57, 44, 0.18);">
                        Please review the highlighted fields and try again.
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.yoga.store') }}">
                    @csrf

                    <div class="admin-form-grid">
                        <div class="admin-field-full">
                            <label for="name" class="admin-label">Session name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="admin-input" placeholder="e.g. Morning Vinyasa Flow" required>
                            <span class="admin-hint">Keep the title clear, concise, and easy to recognize in the planner.</span>
                            @error('name')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="goal" class="admin-label">Primary goal</label>
                            <select id="goal" name="goal" class="admin-select" required>
                                <option value="weight_loss" @selected($goal === 'weight_loss')>Weight Loss</option>
                                <option value="stress_relief" @selected($goal === 'stress_relief')>Stress Relief</option>
                                <option value="flexibility" @selected($goal === 'flexibility')>Flexibility</option>
                            </select>
                            <span class="admin-hint">This determines which users can receive the session.</span>
                            @error('goal')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="level" class="admin-label">Experience level</label>
                            <select id="level" name="level" class="admin-select" required>
                                <option value="beginner" @selected($level === 'beginner')>Beginner</option>
                                <option value="intermediate" @selected($level === 'intermediate')>Intermediate</option>
                                <option value="advanced" @selected($level === 'advanced')>Advanced</option>
                            </select>
                            <span class="admin-hint">Choose the level that best matches the true difficulty.</span>
                            @error('level')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration" class="admin-label">Duration in minutes</label>
                            <input id="duration" type="number" min="1" name="duration" value="{{ old('duration') }}" class="admin-input" placeholder="e.g. 30" required>
                            <span class="admin-hint">Use a practical estimate, not an ideal one.</span>
                            @error('duration')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-field-full">
                            <label for="description" class="admin-label">Description</label>
                            <textarea id="description" name="description" class="admin-textarea" placeholder="Describe the focus, style, or intended outcome of the session.">{{ old('description') }}</textarea>
                            <span class="admin-hint">Optional, but helpful for internal management and future UI improvements.</span>
                        </div>
                    </div>

                    <div class="admin-tip">
                        Try to balance your library across goals and levels. A small, well-structured set of sessions usually works better than a large collection with unclear tags.
                    </div>

                    <div class="admin-form-actions">
                        <p class="admin-form-copy">
                            Saving will make this yoga session immediately available to the planner when a user’s goal and level match it.
                        </p>

                        <div class="admin-actions">
                            <a href="{{ route('admin.yoga') }}" class="admin-button-secondary">Back to Yoga List</a>
                            <button type="submit" class="admin-button-primary">Save Yoga Session</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
