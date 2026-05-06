<x-app-layout>
    @php
        $goal = old('goal', $preference->goal ?? 'stress_relief');
        $experience = old('experience_level', $preference->experience_level ?? 'beginner');
    @endphp

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');

    :root {
        --pref-sage-light: #c4d9c6;
        --pref-sage-dark: #3e5e42;
        --pref-clay: #c87941;
        --pref-clay-light: #f0d5bc;
        --pref-cream: #fffef9;
        --pref-ink: #2a2a27;
        --pref-muted: #6b6b63;
        --pref-line: rgba(42, 42, 39, 0.12);
        --pref-glass: rgba(255, 255, 255, 0.72);
        --pref-glass-strong: rgba(255, 254, 249, 0.88);
    }

    .pref-page {
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 6rem);
        font-family: 'DM Sans', sans-serif;
        color: var(--pref-ink);
    }

    .pref-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        background:
            linear-gradient(140deg, rgba(255, 254, 249, 0.72), rgba(196, 217, 198, 0.4) 48%, rgba(240, 213, 188, 0.45)),
            url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1800&q=80&auto=format&fit=crop') center center / cover no-repeat;
    }

    .pref-bg::before,
    .pref-bg::after {
        content: '';
        position: absolute;
        border-radius: 9999px;
        filter: blur(12px);
    }

    .pref-bg::before {
        top: 8%;
        left: -8rem;
        width: 18rem;
        height: 18rem;
        background: rgba(196, 217, 198, 0.36);
    }

    .pref-bg::after {
        right: -6rem;
        bottom: 10%;
        width: 16rem;
        height: 16rem;
        background: rgba(240, 213, 188, 0.42);
    }

    .pref-wrap {
        position: relative;
        z-index: 1;
        max-width: 1180px;
        margin: 0 auto;
        padding: 3.5rem 1.25rem 5rem;
    }

    .pref-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.92fr) minmax(0, 1.08fr);
        gap: 1.5rem;
        align-items: start;
    }

    .pref-panel,
    .pref-form-card,
    .pref-note,
    .pref-tip {
        background: var(--pref-glass);
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0 20px 50px rgba(42, 42, 39, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .pref-panel,
    .pref-form-card {
        border-radius: 30px;
    }

    .pref-panel {
        padding: 2rem;
    }

    .pref-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        border-radius: 9999px;
        padding: 0.45rem 0.85rem;
        background: rgba(255, 255, 255, 0.58);
        color: var(--pref-sage-dark);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .pref-kicker::before {
        content: '';
        width: 0.45rem;
        height: 0.45rem;
        border-radius: 9999px;
        background: var(--pref-clay);
        box-shadow: 0 0 0 6px rgba(200, 121, 65, 0.1);
    }

    .pref-title,
    .pref-card-title,
    .pref-stat-value {
        font-family: 'Playfair Display', serif;
    }

    .pref-title {
        margin-top: 1.4rem;
        font-size: clamp(2.4rem, 4vw, 4.2rem);
        line-height: 0.98;
        letter-spacing: -0.05em;
        color: var(--pref-ink);
    }

    .pref-title em {
        color: var(--pref-sage-dark);
        font-style: italic;
    }

    .pref-copy {
        margin-top: 1.15rem;
        max-width: 33rem;
        font-size: 1rem;
        line-height: 1.8;
        color: var(--pref-muted);
    }

    .pref-feature-list {
        margin-top: 1.75rem;
        display: grid;
        gap: 0.95rem;
    }

    .pref-feature {
        display: flex;
        gap: 0.95rem;
        align-items: flex-start;
        padding: 1rem 1.05rem;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.46);
        border: 1px solid rgba(255, 255, 255, 0.48);
    }

    .pref-feature-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.9rem;
        height: 2.9rem;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(196, 217, 198, 0.95), rgba(240, 213, 188, 0.8));
        color: var(--pref-sage-dark);
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .pref-feature strong {
        display: block;
        font-size: 0.98rem;
        font-weight: 600;
        color: var(--pref-ink);
    }

    .pref-feature span {
        display: block;
        margin-top: 0.3rem;
        font-size: 0.92rem;
        line-height: 1.65;
        color: var(--pref-muted);
    }

    .pref-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
        margin-top: 1.6rem;
    }

    .pref-note,
    .pref-tip {
        border-radius: 24px;
        padding: 1.1rem 1.2rem;
    }

    .pref-stat-label {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--pref-muted);
    }

    .pref-stat-value {
        margin-top: 0.55rem;
        font-size: 1.9rem;
        line-height: 1;
        color: var(--pref-ink);
    }

    .pref-stat-sub {
        margin-top: 0.45rem;
        font-size: 0.9rem;
        color: var(--pref-muted);
    }

    .pref-form-card {
        padding: 2rem;
        background: var(--pref-glass-strong);
    }

    .pref-form-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.6rem;
    }

    .pref-card-title {
        font-size: 2rem;
        line-height: 1.05;
        letter-spacing: -0.04em;
    }

    .pref-card-copy {
        margin-top: 0.6rem;
        max-width: 29rem;
        color: var(--pref-muted);
        line-height: 1.7;
    }

    .pref-badge {
        flex-shrink: 0;
        border-radius: 9999px;
        padding: 0.55rem 0.9rem;
        background: rgba(62, 94, 66, 0.09);
        color: var(--pref-sage-dark);
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .pref-alert {
        margin-bottom: 1rem;
        border-radius: 20px;
        padding: 0.95rem 1rem;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .pref-alert-error {
        background: rgba(190, 57, 44, 0.08);
        border: 1px solid rgba(190, 57, 44, 0.18);
        color: #8e3328;
    }

    .pref-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.2rem;
    }

    .pref-field-full {
        grid-column: 1 / -1;
    }

    .pref-label {
        display: block;
        margin-bottom: 0.6rem;
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--pref-ink);
    }

    .pref-hint {
        display: block;
        margin-top: 0.35rem;
        font-size: 0.82rem;
        color: var(--pref-muted);
    }

    .pref-input,
    .pref-select {
        width: 100%;
        border-radius: 18px;
        border: 1px solid rgba(42, 42, 39, 0.1);
        background: rgba(255, 255, 255, 0.82);
        padding: 0.95rem 1rem;
        color: var(--pref-ink);
        outline: none;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
        transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }

    .pref-input:focus,
    .pref-select:focus {
        border-color: rgba(62, 94, 66, 0.32);
        box-shadow: 0 0 0 4px rgba(196, 217, 198, 0.35);
        transform: translateY(-1px);
    }

    .pref-error {
        margin-top: 0.45rem;
        font-size: 0.83rem;
        color: #9b3a2e;
    }

    .pref-quick-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.75rem;
        margin-top: 0.8rem;
    }

    .pref-tip {
        background: rgba(42, 42, 39, 0.9);
        border-color: rgba(255, 255, 255, 0.08);
        color: rgba(255, 254, 249, 0.92);
        margin-top: 1.6rem;
    }

    .pref-tip-label {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: rgba(255, 254, 249, 0.6);
    }

    .pref-tip-label::before {
        content: '';
        width: 0.42rem;
        height: 0.42rem;
        border-radius: 9999px;
        background: #f0d5bc;
    }

    .pref-tip p {
        margin-top: 0.7rem;
        line-height: 1.75;
        color: rgba(255, 254, 249, 0.78);
    }

    .pref-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 1.75rem;
        padding-top: 1.4rem;
        border-top: 1px solid var(--pref-line);
    }

    .pref-actions-copy {
        max-width: 22rem;
        font-size: 0.9rem;
        line-height: 1.7;
        color: var(--pref-muted);
    }

    .pref-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.7rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, var(--pref-sage-dark), #547659);
        color: var(--pref-cream);
        padding: 0.95rem 1.55rem;
        font-weight: 600;
        box-shadow: 0 18px 28px rgba(62, 94, 66, 0.22);
        transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .pref-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 22px 36px rgba(62, 94, 66, 0.26);
        filter: brightness(1.03);
    }

    @media (max-width: 1024px) {
        .pref-grid {
            grid-template-columns: 1fr;
        }

        .pref-panel {
            order: 2;
        }

        .pref-form-card {
            order: 1;
        }
    }

    @media (max-width: 720px) {
        .pref-wrap {
            padding: 2rem 0.9rem 4rem;
        }

        .pref-panel,
        .pref-form-card {
            padding: 1.35rem;
            border-radius: 24px;
        }

        .pref-form-grid,
        .pref-stats,
        .pref-quick-grid {
            grid-template-columns: 1fr;
        }

        .pref-form-head,
        .pref-actions {
            flex-direction: column;
            align-items: flex-start;
        }

        .pref-submit {
            width: 100%;
        }
    }
    </style>

    <div class="pref-page">
        <div class="pref-bg"></div>

        <div class="pref-wrap">
            <div class="pref-grid">
                <section class="pref-panel">
                    <span class="pref-kicker">Personal practice design</span>

                    <h1 class="pref-title">
                        Shape a plan that feels <em>intentional</em>, balanced, and sustainable.
                    </h1>

                    <p class="pref-copy">
                        Your preferences guide how the app blends yoga and meditation into a routine that fits your goals, energy, and real schedule. A few thoughtful details here make every plan feel more personal.
                    </p>

                    <div class="pref-feature-list">
                        <div class="pref-feature">
                            <div class="pref-feature-icon">01</div>
                            <div>
                                <strong>Goal-first recommendations</strong>
                                <span>We tune sessions toward flexibility, stress relief, or weight-focused movement without losing balance.</span>
                            </div>
                        </div>

                        <div class="pref-feature">
                            <div class="pref-feature-icon">02</div>
                            <div>
                                <strong>Right-sized intensity</strong>
                                <span>Your experience level helps keep the practice supportive for beginners and still engaging for advanced users.</span>
                            </div>
                        </div>

                        <div class="pref-feature">
                            <div class="pref-feature-icon">03</div>
                            <div>
                                <strong>Built for your calendar</strong>
                                <span>Available time shapes realistic daily sessions so the plan is easier to follow consistently.</span>
                            </div>
                        </div>
                    </div>

                    <div class="pref-stats">
                        <div class="pref-note">
                            <div class="pref-stat-label">Plan quality</div>
                            <div class="pref-stat-value">Tailored</div>
                            <div class="pref-stat-sub">Inputs are used to personalize your weekly flow.</div>
                        </div>

                        <div class="pref-note">
                            <div class="pref-stat-label">Update anytime</div>
                            <div class="pref-stat-value">Flexible</div>
                            <div class="pref-stat-sub">Change your settings as goals or availability evolve.</div>
                        </div>
                    </div>
                </section>

                <section class="pref-form-card">
                    <div class="pref-form-head">
                        <div>
                            <h2 class="pref-card-title">Your practice preferences</h2>
                            <p class="pref-card-copy">
                                Keep this simple and honest. The strongest plans usually come from realistic time, clear intent, and a level that matches where you are today.
                            </p>
                        </div>

                        <span class="pref-badge">4 key inputs</span>
                    </div>

                    @if ($errors->any())
                        <div class="pref-alert pref-alert-error">
                            Please review the highlighted fields and try again.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('preferences.store') }}">
                        @csrf

                        <div class="pref-form-grid">
                            <div>
                                <label for="age" class="pref-label">Age</label>
                                <input
                                    id="age"
                                    type="number"
                                    name="age"
                                    min="10"
                                    max="100"
                                    value="{{ old('age', $preference->age ?? '') }}"
                                    class="pref-input"
                                    placeholder="Enter your age"
                                    required
                                >
                                <span class="pref-hint">Used to keep recommendations realistic and age-appropriate.</span>
                                @error('age')
                                    <p class="pref-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="available_time" class="pref-label">Available time per day</label>
                                <input
                                    id="available_time"
                                    type="number"
                                    name="available_time"
                                    min="5"
                                    max="180"
                                    value="{{ old('available_time', $preference->available_time ?? '') }}"
                                    class="pref-input"
                                    placeholder="e.g. 30"
                                    required
                                >
                                <span class="pref-hint">Choose a number in minutes that you can realistically sustain.</span>
                                @error('available_time')
                                    <p class="pref-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="goal" class="pref-label">Primary goal</label>
                                <select id="goal" name="goal" class="pref-select" required>
                                    <option value="weight_loss" @selected($goal === 'weight_loss')>Weight Loss</option>
                                    <option value="stress_relief" @selected($goal === 'stress_relief')>Stress Relief</option>
                                    <option value="flexibility" @selected($goal === 'flexibility')>Flexibility</option>
                                </select>
                                <span class="pref-hint">This sets the overall direction for your plan.</span>
                                @error('goal')
                                    <p class="pref-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="experience_level" class="pref-label">Experience level</label>
                                <select id="experience_level" name="experience_level" class="pref-select" required>
                                    <option value="beginner" @selected($experience === 'beginner')>Beginner</option>
                                    <option value="intermediate" @selected($experience === 'intermediate')>Intermediate</option>
                                    <option value="advanced" @selected($experience === 'advanced')>Advanced</option>
                                </select>
                                <span class="pref-hint">Select the level that best reflects your current practice, not your ideal one.</span>
                                @error('experience_level')
                                    <p class="pref-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pref-field-full">
                                <div class="pref-note">
                                    <div class="pref-stat-label">Suggested time bands</div>
                                    <div class="pref-quick-grid">
                                        <div>
                                            <div class="pref-stat-value">15m</div>
                                            <div class="pref-stat-sub">Light reset for busy days</div>
                                        </div>
                                        <div>
                                            <div class="pref-stat-value">30m</div>
                                            <div class="pref-stat-sub">Balanced daily practice</div>
                                        </div>
                                        <div>
                                            <div class="pref-stat-value">45m+</div>
                                            <div class="pref-stat-sub">Deeper strength and recovery work</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pref-tip">
                            <span class="pref-tip-label">Planning note</span>
                            <p>
                                If your schedule changes week to week, choose the time you can maintain most consistently. A shorter steady plan usually works better than an ambitious one that is hard to keep.
                            </p>
                        </div>

                        <div class="pref-actions">
                            <p class="pref-actions-copy">
                                Saving will update your personal profile and use these settings the next time your plan is generated.
                            </p>

                            <button type="submit" class="pref-submit">
                                Save Preferences
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
