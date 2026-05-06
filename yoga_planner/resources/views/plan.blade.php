<x-app-layout>
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

        $goalLabel = $goalLabels[$preference->goal] ?? ucfirst(str_replace('_', ' ', $preference->goal));
        $levelLabel = $levelLabels[$preference->experience_level] ?? ucfirst($preference->experience_level);
        $yogaMinutes = $yoga->sum('duration');
        $meditationMinutes = $meditation->sum('duration');
        $totalMinutes = $yogaMinutes + $meditationMinutes;
    @endphp

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');

    :root {
        --plan-sage-light: #c4d9c6;
        --plan-sage-dark: #3e5e42;
        --plan-clay: #c87941;
        --plan-clay-light: #f0d5bc;
        --plan-cream: #fffef9;
        --plan-ink: #2a2a27;
        --plan-muted: #6b6b63;
        --plan-line: rgba(42, 42, 39, 0.12);
        --plan-glass: rgba(255, 255, 255, 0.74);
        --plan-glass-strong: rgba(255, 254, 249, 0.88);
    }

    .plan-page {
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 6rem);
        font-family: 'DM Sans', sans-serif;
        color: var(--plan-ink);
    }

    .plan-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        background:
            linear-gradient(155deg, rgba(255, 254, 249, 0.8), rgba(196, 217, 198, 0.45) 46%, rgba(240, 213, 188, 0.42)),
            url('https://images.unsplash.com/photo-1518611012118-696072aa579a?w=1800&q=80&auto=format&fit=crop') center center / cover no-repeat;
    }

    .plan-bg::before,
    .plan-bg::after {
        content: '';
        position: absolute;
        border-radius: 9999px;
        filter: blur(14px);
    }

    .plan-bg::before {
        top: 6%;
        left: -7rem;
        width: 18rem;
        height: 18rem;
        background: rgba(196, 217, 198, 0.4);
    }

    .plan-bg::after {
        right: -6rem;
        bottom: 8%;
        width: 17rem;
        height: 17rem;
        background: rgba(240, 213, 188, 0.42);
    }

    .plan-wrap {
        position: relative;
        z-index: 1;
        max-width: 1180px;
        margin: 0 auto;
        padding: 3.5rem 1.25rem 5rem;
    }

    .plan-hero,
    .plan-card,
    .plan-summary,
    .plan-session,
    .plan-success {
        background: var(--plan-glass);
        border: 1px solid rgba(255, 255, 255, 0.68);
        box-shadow: 0 20px 52px rgba(42, 42, 39, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .plan-hero,
    .plan-card,
    .plan-summary {
        border-radius: 30px;
    }

    .plan-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
        gap: 1.5rem;
        padding: 2rem;
    }

    .plan-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        border-radius: 9999px;
        padding: 0.45rem 0.85rem;
        background: rgba(255, 255, 255, 0.56);
        color: var(--plan-sage-dark);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .plan-kicker::before {
        content: '';
        width: 0.45rem;
        height: 0.45rem;
        border-radius: 9999px;
        background: var(--plan-clay);
        box-shadow: 0 0 0 6px rgba(200, 121, 65, 0.1);
    }

    .plan-title,
    .plan-title em,
    .plan-card-title,
    .plan-summary-value,
    .plan-session-title {
        font-family: 'Playfair Display', serif;
    }

    .plan-title {
        margin-top: 1.35rem;
        font-size: clamp(2.4rem, 4vw, 4.1rem);
        line-height: 0.98;
        letter-spacing: -0.05em;
    }

    .plan-title em {
        color: var(--plan-sage-dark);
        font-style: italic;
    }

    .plan-copy {
        margin-top: 1rem;
        max-width: 36rem;
        color: var(--plan-muted);
        line-height: 1.8;
        font-size: 1rem;
    }

    .plan-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .plan-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.58);
        padding: 0.7rem 1rem;
        color: var(--plan-ink);
        font-size: 0.92rem;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.55);
    }

    .plan-tag strong {
        color: var(--plan-sage-dark);
    }

    .plan-summary {
        padding: 1.4rem;
        background: var(--plan-glass-strong);
    }

    .plan-summary-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.95rem;
    }

    .plan-summary-card {
        border-radius: 24px;
        padding: 1.15rem;
        background: rgba(255, 255, 255, 0.62);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .plan-summary-label {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--plan-muted);
    }

    .plan-summary-value {
        margin-top: 0.55rem;
        font-size: 2rem;
        line-height: 1;
    }

    .plan-summary-sub {
        margin-top: 0.45rem;
        font-size: 0.9rem;
        color: var(--plan-muted);
        line-height: 1.6;
    }

    .plan-success {
        margin-top: 1rem;
        padding: 1rem 1.15rem;
        border-radius: 22px;
        background: rgba(196, 217, 198, 0.5);
        color: var(--plan-sage-dark);
        font-weight: 500;
    }

    .plan-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .plan-card {
        padding: 1.75rem;
    }

    .plan-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.3rem;
    }

    .plan-card-title {
        font-size: 2rem;
        line-height: 1;
        letter-spacing: -0.04em;
    }

    .plan-card-copy {
        margin-top: 0.55rem;
        color: var(--plan-muted);
        line-height: 1.75;
    }

    .plan-pill {
        flex-shrink: 0;
        border-radius: 9999px;
        padding: 0.55rem 0.85rem;
        font-size: 0.76rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .plan-pill-yoga {
        background: rgba(196, 217, 198, 0.34);
        color: var(--plan-sage-dark);
    }

    .plan-pill-meditation {
        background: rgba(240, 213, 188, 0.42);
        color: var(--plan-clay);
    }

    .plan-session-list {
        display: grid;
        gap: 1rem;
    }

    .plan-session {
        border-radius: 24px;
        padding: 1.1rem 1.15rem;
        background: rgba(255, 255, 255, 0.54);
    }

    .plan-session-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
    }

    .plan-session-title {
        font-size: 1.35rem;
        line-height: 1.1;
        letter-spacing: -0.02em;
    }

    .plan-session-meta {
        margin-top: 0.35rem;
        color: var(--plan-muted);
        font-size: 0.92rem;
    }

    .plan-duration {
        flex-shrink: 0;
        border-radius: 9999px;
        padding: 0.45rem 0.75rem;
        background: rgba(42, 42, 39, 0.06);
        color: var(--plan-ink);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .plan-session-copy {
        margin-top: 0.8rem;
        color: var(--plan-muted);
        line-height: 1.7;
        font-size: 0.94rem;
    }

    .plan-empty {
        border-radius: 24px;
        padding: 1.35rem;
        background: rgba(255, 255, 255, 0.52);
        color: var(--plan-muted);
        line-height: 1.75;
    }

    .plan-video-card {
        margin-top: 1.15rem;
        border-radius: 24px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.56);
        border: 1px solid rgba(255, 255, 255, 0.58);
        box-shadow: 0 18px 38px rgba(42, 42, 39, 0.08);
    }

    .plan-video-frame {
        aspect-ratio: 16 / 9;
        background: rgba(42, 42, 39, 0.08);
    }

    .plan-video-frame iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    .plan-video-body {
        padding: 1rem 1.1rem 1.15rem;
    }

    .plan-video-label {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--plan-muted);
        margin-bottom: 0.7rem;
    }

    .plan-video-label::before {
        content: '';
        width: 0.42rem;
        height: 0.42rem;
        border-radius: 999px;
        background: var(--plan-clay);
    }

    .plan-video-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        line-height: 1.08;
        letter-spacing: -0.03em;
    }

    .plan-video-sub {
        margin-top: 0.45rem;
        color: var(--plan-muted);
        line-height: 1.72;
        font-size: 0.92rem;
    }

    .plan-video-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.55rem;
        margin-top: 0.85rem;
    }

    .plan-video-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 0.45rem 0.75rem;
        background: rgba(196, 217, 198, 0.28);
        color: var(--plan-sage-dark);
        font-size: 0.78rem;
        font-weight: 500;
    }

    .plan-footer {
        margin-top: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-top: 1.4rem;
        border-top: 1px solid var(--plan-line);
    }

    .plan-footer-copy {
        max-width: 30rem;
        color: var(--plan-muted);
        line-height: 1.75;
        font-size: 0.95rem;
    }

    .plan-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        align-items: center;
    }

    .plan-primary,
    .plan-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        border-radius: 9999px;
        padding: 0.95rem 1.45rem;
        font-weight: 600;
        transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .plan-primary {
        background: linear-gradient(135deg, var(--plan-sage-dark), #547659);
        color: var(--plan-cream);
        box-shadow: 0 18px 28px rgba(62, 94, 66, 0.22);
    }

    .plan-secondary {
        background: rgba(255, 255, 255, 0.72);
        color: var(--plan-ink);
        border: 1px solid rgba(42, 42, 39, 0.08);
    }

    .plan-primary:hover,
    .plan-secondary:hover {
        transform: translateY(-2px);
    }

    .plan-primary:hover {
        box-shadow: 0 22px 36px rgba(62, 94, 66, 0.26);
        filter: brightness(1.03);
    }

    @media (max-width: 1024px) {
        .plan-hero,
        .plan-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .plan-wrap {
            padding: 2rem 0.9rem 4rem;
        }

        .plan-hero,
        .plan-card,
        .plan-summary {
            padding: 1.35rem;
            border-radius: 24px;
        }

        .plan-summary-grid {
            grid-template-columns: 1fr;
        }

        .plan-card-head,
        .plan-session-head,
        .plan-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .plan-actions,
        .plan-primary,
        .plan-secondary {
            width: 100%;
        }
    }
    </style>

    <div class="plan-page">
        <div class="plan-bg"></div>

        <div class="plan-wrap">
            <section class="plan-hero">
                <div>
                    <span class="plan-kicker">Personalized weekly flow</span>

                    <h1 class="plan-title">
                        Your plan is built for <em>{{ $goalLabel }}</em> with a pace that fits real life.
                    </h1>

                    <p class="plan-copy">
                        This routine combines movement and stillness in a way that reflects your available time, experience level, and current focus. Use it as your steady baseline, then refine as your practice evolves.
                    </p>

                    <div class="plan-tags">
                        <span class="plan-tag"><strong>Goal:</strong> {{ $goalLabel }}</span>
                        <span class="plan-tag"><strong>Level:</strong> {{ $levelLabel }}</span>
                        <span class="plan-tag"><strong>Available time:</strong> {{ $preference->available_time }} min/day</span>
                    </div>
                </div>

                <div class="plan-summary">
                    <div class="plan-summary-grid">
                        <div class="plan-summary-card">
                            <div class="plan-summary-label">Current streak</div>
                            <div class="plan-summary-value">{{ $streak }}</div>
                            <div class="plan-summary-sub">Consecutive day{{ $streak === 1 ? '' : 's' }} of completed practice.</div>
                        </div>

                        <div class="plan-summary-card">
                            <div class="plan-summary-label">Total plan time</div>
                            <div class="plan-summary-value">{{ $totalMinutes }}</div>
                            <div class="plan-summary-sub">Combined minutes across yoga and meditation suggestions.</div>
                        </div>

                        <div class="plan-summary-card">
                            <div class="plan-summary-label">Yoga sessions</div>
                            <div class="plan-summary-value">{{ $yoga->count() }}</div>
                            <div class="plan-summary-sub">{{ $yogaMinutes }} minutes curated for your goal and level.</div>
                        </div>

                        <div class="plan-summary-card">
                            <div class="plan-summary-label">Meditations</div>
                            <div class="plan-summary-value">{{ $meditation->count() }}</div>
                            <div class="plan-summary-sub">{{ $meditationMinutes }} minutes chosen to support recovery and focus.</div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="plan-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </section>

            <section class="plan-grid">
                <div class="plan-card">
                    <div class="plan-card-head">
                        <div>
                            <h2 class="plan-card-title">Yoga plan</h2>
                            <p class="plan-card-copy">
                                Session suggestions tailored to your goal and experience level, designed to keep progress steady without overwhelming your schedule.
                            </p>
                        </div>

                        <span class="plan-pill plan-pill-yoga">Movement</span>
                    </div>

                    <div class="plan-session-list">
                        @forelse($yoga as $session)
                            <article class="plan-session">
                                <div class="plan-session-head">
                                    <div>
                                        <h3 class="plan-session-title">{{ $session->name }}</h3>
                                        <p class="plan-session-meta">{{ $goalLabel }} . {{ ucfirst($session->level) }}</p>
                                    </div>

                                    <span class="plan-duration">{{ $session->duration }} min</span>
                                </div>

                                <p class="plan-session-copy">
                                    {{ $session->description ?: 'A focused yoga session chosen to support your current goal while matching your present level of practice.' }}
                                </p>
                            </article>
                        @empty
                            <div class="plan-empty">
                                No yoga sessions currently match this exact combination of goal and level. Update your preferences or add more sessions from the admin area to expand the plan.
                            </div>
                        @endforelse

                        <div class="plan-video-card">
                            <div class="plan-video-frame">
                                <iframe
                                    src="https://www.youtube-nocookie.com/embed/{{ $planVideoRecommendations['yoga']['youtube_id'] }}"
                                    title="{{ $planVideoRecommendations['yoga']['title'] }}"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>
                            </div>
                            <div class="plan-video-body">
                                <div class="plan-video-label">Suggested yoga video</div>
                                <div class="plan-video-title">{{ $planVideoRecommendations['yoga']['title'] }}</div>
                                <div class="plan-video-sub">{{ $planVideoRecommendations['yoga']['subtitle'] }}</div>
                                <div class="plan-video-meta">
                                    <span class="plan-video-chip">{{ $planVideoRecommendations['goal_label'] }}</span>
                                    <span class="plan-video-chip">{{ $planVideoRecommendations['level_label'] }}</span>
                                    <span class="plan-video-chip">{{ $planVideoRecommendations['yoga']['duration'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="plan-card">
                    <div class="plan-card-head">
                        <div>
                            <h2 class="plan-card-title">Meditation plan</h2>
                            <p class="plan-card-copy">
                                Complementary mindfulness sessions that help reinforce the same outcome with breathing, recovery, and mental focus.
                            </p>
                        </div>

                        <span class="plan-pill plan-pill-meditation">Stillness</span>
                    </div>

                    <div class="plan-session-list">
                        @forelse($meditation as $session)
                            <article class="plan-session">
                                <div class="plan-session-head">
                                    <div>
                                        <h3 class="plan-session-title">{{ $session->name }}</h3>
                                        <p class="plan-session-meta">{{ $goalLabel }} support</p>
                                    </div>

                                    <span class="plan-duration">{{ $session->duration }} min</span>
                                </div>

                                <p class="plan-session-copy">
                                    {{ $session->description ?: 'A meditation session selected to support consistency, calm, and recovery alongside your physical practice.' }}
                                </p>
                            </article>
                        @empty
                            <div class="plan-empty">
                                No meditation sessions are available for this goal yet. You can still complete yoga sessions now and add targeted meditations later.
                            </div>
                        @endforelse

                        <div class="plan-video-card">
                            <div class="plan-video-frame">
                                <iframe
                                    src="https://www.youtube-nocookie.com/embed/{{ $planVideoRecommendations['meditation']['youtube_id'] }}"
                                    title="{{ $planVideoRecommendations['meditation']['title'] }}"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>
                            </div>
                            <div class="plan-video-body">
                                <div class="plan-video-label">Suggested meditation video</div>
                                <div class="plan-video-title">{{ $planVideoRecommendations['meditation']['title'] }}</div>
                                <div class="plan-video-sub">{{ $planVideoRecommendations['meditation']['subtitle'] }}</div>
                                <div class="plan-video-meta">
                                    <span class="plan-video-chip">{{ $planVideoRecommendations['goal_label'] }}</span>
                                    <span class="plan-video-chip">Recovery support</span>
                                    <span class="plan-video-chip">{{ $planVideoRecommendations['meditation']['duration'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="plan-card" style="margin-top: 1.5rem;">
                <div class="plan-footer">
                    <p class="plan-footer-copy">
                        When you finish today, mark the plan complete to keep your streak accurate. If your goal or available time changes, update your preferences and regenerate a better-fit routine.
                    </p>

                    <div class="plan-actions">
                        <form method="POST" action="{{ route('complete') }}">
                            @csrf
                            <button type="submit" class="plan-primary">
                                Mark Today Complete
                                <span aria-hidden="true">+</span>
                            </button>
                        </form>

                        <a href="{{ route('preferences.create') }}" class="plan-secondary">
                            Refine Preferences
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
