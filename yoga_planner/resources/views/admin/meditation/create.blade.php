<x-app-layout>
    @include('admin.partials.theme')

    @php
        $type = old('type', 'stress_relief');
    @endphp

    <div class="admin-page">
        <div class="admin-bg" style="--admin-bg-image: url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1800&q=80&auto=format&fit=crop');"></div>

        <div class="admin-wrap">
            <section class="admin-shell">
                <span class="admin-kicker">Admin meditation authoring</span>
                <h1 class="admin-title">Add meditation content that stays tightly <em>aligned</em> with the planner.</h1>
                <p class="admin-copy">
                    Meditation sessions are matched by user goal, so choosing the right type is what makes the plan feel coherent. Keep the duration grounded and the naming clear.
                </p>

                <div class="admin-stats">
                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Best for</div>
                        <div class="admin-stat-value">Support</div>
                        <div class="admin-stat-sub">Meditation should reinforce the same objective as the user’s movement plan.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Planner logic</div>
                        <div class="admin-stat-value">Type = Goal</div>
                        <div class="admin-stat-sub">Use app goal names so the session can actually appear in user plans.</div>
                    </div>

                    <div class="admin-stat-card">
                        <div class="admin-stat-label">Keep it usable</div>
                        <div class="admin-stat-value">Short and clear</div>
                        <div class="admin-stat-sub">Meditations often work best when titles and durations are simple and approachable.</div>
                    </div>
                </div>
            </section>

            <section class="admin-card" style="margin-top: 1.5rem;">
                <div class="admin-form-head">
                    <div>
                        <h2 class="admin-card-title">Create meditation session</h2>
                        <p class="admin-card-copy">
                            Add the core details below. Keeping the type aligned with app goals ensures the session can be surfaced by the planner.
                        </p>
                    </div>

                    <span class="admin-pill">New record</span>
                </div>

                @if ($errors->any())
                    <div class="admin-empty" style="background: rgba(190, 57, 44, 0.08); color: #8e3328; border-color: rgba(190, 57, 44, 0.18);">
                        Please review the highlighted fields and try again.
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.meditation.store') }}">
                    @csrf

                    <div class="admin-form-grid">
                        <div class="admin-field-full">
                            <label for="name" class="admin-label">Session name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="admin-input" placeholder="e.g. Evening Calm Reset" required>
                            <span class="admin-hint">Use a name that feels readable and calming in the user plan.</span>
                            @error('name')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="admin-label">Planner goal type</label>
                            <select id="type" name="type" class="admin-select" required>
                                <option value="weight_loss" @selected($type === 'weight_loss')>Weight Loss</option>
                                <option value="stress_relief" @selected($type === 'stress_relief')>Stress Relief</option>
                                <option value="flexibility" @selected($type === 'flexibility')>Flexibility</option>
                            </select>
                            <span class="admin-hint">This should match the user goal names used elsewhere in the app.</span>
                            @error('type')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration" class="admin-label">Duration in minutes</label>
                            <input id="duration" type="number" min="1" name="duration" value="{{ old('duration') }}" class="admin-input" placeholder="e.g. 12" required>
                            <span class="admin-hint">Shorter meditation sessions usually fit more plans successfully.</span>
                            @error('duration')
                                <p class="admin-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-field-full">
                            <label for="description" class="admin-label">Description</label>
                            <textarea id="description" name="description" class="admin-textarea" placeholder="Describe the tone, breathing pattern, or intended mental outcome.">{{ old('description') }}</textarea>
                            <span class="admin-hint">Optional, but useful for maintaining a high-quality content library.</span>
                        </div>
                    </div>

                    <div class="admin-tip">
                        Because the current planner queries meditation sessions by goal type, using values like weight loss, stress relief, and flexibility will keep the system consistent.
                    </div>

                    <div class="admin-form-actions">
                        <p class="admin-form-copy">
                            Saving will make this meditation session available to the planner anywhere its goal type matches a user’s saved preference.
                        </p>

                        <div class="admin-actions">
                            <a href="{{ route('admin.meditation') }}" class="admin-button-secondary">Back to Meditation List</a>
                            <button type="submit" class="admin-button-primary">Save Meditation Session</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
