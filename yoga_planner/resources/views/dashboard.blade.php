<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --sage-light: #C4D9C6;
    --sage-dark: #3E5E42;
    --clay: #C87941;
    --clay-light: #F0D5BC;
    --warm-white: #FFFEF9;
    --charcoal: #2A2A27;
    --muted: #6B6B63;
    --line: rgba(42,42,39,0.12);
    --glass: rgba(255,255,255,0.72);
    --glass-border: rgba(255,255,255,0.55);
}

.du-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image: url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1920&q=80&auto=format&fit=crop');
    background-size: cover;
    background-position: center top;
    background-repeat: no-repeat;
}

.du-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(160deg, rgba(250,247,240,0.83) 0%, rgba(196,217,198,0.55) 45%, rgba(240,213,188,0.45) 100%);
}

.du-wrap {
    font-family: 'DM Sans', sans-serif;
    position: relative;
    z-index: 1;
    max-width: 1120px;
    margin: 0 auto;
    padding: 48px 40px 80px;
    color: var(--charcoal);
}

.du-glass {
    background: var(--glass);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid var(--glass-border);
    box-shadow: 0 8px 32px rgba(42,42,39,0.08);
}

.du-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 36px;
    animation: duUp 0.55s ease both;
}

.du-greeting {
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 6px;
}

.du-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3.6vw, 46px);
    font-weight: 700;
    letter-spacing: -1.5px;
    color: var(--charcoal);
    line-height: 1.08;
}

.du-title em {
    font-style: italic;
    color: var(--sage-dark);
}

.du-date {
    text-align: right;
    font-size: 13px;
    color: var(--muted);
}

.du-date strong {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--charcoal);
}

.du-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 28px;
    animation: duUp 0.55s ease 0.08s both;
}

.du-stat {
    border-radius: 20px;
    padding: 22px 20px;
    transition: transform 0.22s, box-shadow 0.22s;
}

.du-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 48px rgba(42,42,39,0.12);
}

.du-stat-label {
    font-size: 10.5px;
    color: var(--muted);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 8px;
}

.du-stat-val {
    font-family: 'Playfair Display', serif;
    font-size: 30px;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1;
    margin-bottom: 4px;
}

.du-stat-sub {
    font-size: 11.5px;
    color: var(--muted);
    font-weight: 300;
    line-height: 1.55;
}

.du-stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(62,94,66,0.12);
    color: var(--sage-dark);
    font-size: 10.5px;
    font-weight: 500;
    padding: 3px 9px;
    border-radius: 100px;
    margin-top: 8px;
}

.du-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    animation: duUp 0.55s ease 0.16s both;
}

.du-card {
    border-radius: 22px;
    padding: 32px;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    transition: transform 0.25s, box-shadow 0.25s;
    position: relative;
    overflow: hidden;
}

.du-card::before {
    content: '';
    position: absolute;
    top: -60px;
    right: -60px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    transition: transform 0.4s;
    pointer-events: none;
}

.du-card-pref::before {
    background: radial-gradient(circle, rgba(200,121,65,0.15) 0%, transparent 70%);
}

.du-card-plan::before {
    background: radial-gradient(circle, rgba(62,94,66,0.15) 0%, transparent 70%);
}

.du-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 28px 64px rgba(42,42,39,0.14);
}

.du-card:hover::before {
    transform: scale(1.5);
}

.du-card-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 18px;
    position: relative;
    z-index: 1;
}

.du-card-pref .du-card-icon {
    background: rgba(240,213,188,0.75);
}

.du-card-plan .du-card-icon {
    background: rgba(196,217,198,0.75);
}

.du-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
}

.du-card-desc {
    font-size: 14px;
    color: var(--muted);
    font-weight: 300;
    line-height: 1.65;
    flex: 1;
    position: relative;
    z-index: 1;
    margin-bottom: 20px;
}

.du-card-arrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 500;
    position: relative;
    z-index: 1;
    transition: gap 0.2s;
}

.du-card-pref .du-card-arrow {
    color: var(--clay);
}

.du-card-plan .du-card-arrow {
    color: var(--sage-dark);
}

.du-card:hover .du-card-arrow {
    gap: 14px;
}

.du-arrow-dot {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
}

.du-card-pref .du-arrow-dot {
    background: rgba(240,213,188,0.85);
    color: var(--clay);
}

.du-card-plan .du-arrow-dot {
    background: rgba(196,217,198,0.85);
    color: var(--sage-dark);
}

.du-today {
    grid-column: 1 / -1;
    background: rgba(42,42,39,0.88);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 22px;
    padding: 30px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 12px 48px rgba(42,42,39,0.2);
}

.du-today::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 320px;
    height: 320px;
    background: radial-gradient(circle, rgba(196,217,198,0.09) 0%, transparent 70%);
    pointer-events: none;
}

.du-today-left,
.du-poses,
.du-today-btn {
    position: relative;
    z-index: 1;
}

.du-today-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.14);
    color: rgba(250,247,240,0.65);
    font-size: 10.5px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 100px;
    margin-bottom: 12px;
}

.du-today-pill::before {
    content: '';
    width: 5px;
    height: 5px;
    background: #F0C090;
    border-radius: 50%;
}

.du-today-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: #FAF7F0;
    margin-bottom: 4px;
    letter-spacing: -0.5px;
}

.du-today-sub {
    font-size: 13px;
    color: rgba(250,247,240,0.5);
    font-weight: 300;
}

.du-poses {
    display: flex;
    gap: 10px;
}

.du-pose {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    padding: 12px 15px;
    text-align: center;
    min-width: 82px;
}

.du-pose-icon {
    font-size: 18px;
    font-weight: 700;
    color: #FAF7F0;
    margin-bottom: 4px;
}

.du-pose-name {
    font-size: 10.5px;
    color: rgba(250,247,240,0.55);
}

.du-today-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #FAF7F0;
    color: var(--charcoal);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    padding: 13px 26px;
    border-radius: 100px;
    transition: background 0.2s, transform 0.2s;
    white-space: nowrap;
    flex-shrink: 0;
}

.du-today-btn:hover {
    background: #fff;
    transform: translateY(-2px);
}

.du-section-label {
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: var(--muted);
    margin: 30px 0 14px;
    animation: duUp 0.55s ease 0.24s both;
}

.du-progress-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    animation: duUp 0.55s ease 0.3s both;
}

.du-progress-card {
    border-radius: 18px;
    padding: 22px;
}

.du-progress-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
    gap: 12px;
}

.du-progress-name {
    font-size: 13.5px;
    font-weight: 500;
    color: var(--charcoal);
}

.du-progress-pct {
    font-size: 13px;
    color: var(--muted);
}

.du-bar-bg {
    height: 6px;
    background: rgba(42,42,39,0.1);
    border-radius: 100px;
    overflow: hidden;
    margin-bottom: 10px;
}

.du-bar {
    height: 100%;
    border-radius: 100px;
    background: var(--sage-dark);
    width: 0%;
    transition: width 1.2s ease;
}

.du-bar.clay {
    background: var(--clay);
}

.du-bar.mid {
    background: #8B7FBE;
}

.du-progress-meta {
    font-size: 12px;
    color: var(--muted);
    font-weight: 300;
    line-height: 1.65;
}

.du-video-head {
    display: flex;
    align-items: end;
    justify-content: space-between;
    gap: 18px;
    margin: 34px 0 16px;
    animation: duUp 0.55s ease 0.36s both;
}

.du-video-copy {
    font-size: 13px;
    color: var(--muted);
    max-width: 560px;
    line-height: 1.75;
}

.du-video-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(42,42,39,0.08);
    color: var(--sage-dark);
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    white-space: nowrap;
}

.du-video-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    animation: duUp 0.55s ease 0.42s both;
}

.du-video-card {
    border-radius: 24px;
    overflow: hidden;
}

.du-video-frame {
    aspect-ratio: 16 / 9;
    background: rgba(42,42,39,0.08);
}

.du-video-frame iframe {
    width: 100%;
    height: 100%;
    border: 0;
    display: block;
}

.du-video-body {
    padding: 20px 22px 22px;
}

.du-video-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 10.5px;
    font-weight: 500;
    color: var(--muted);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.du-video-label::before {
    content: '';
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--clay);
}

.du-video-title {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.1;
    margin-bottom: 8px;
}

.du-video-sub {
    font-size: 13px;
    color: var(--muted);
    line-height: 1.75;
    margin-bottom: 16px;
}

.du-video-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.du-video-chip {
    display: inline-flex;
    align-items: center;
    padding: 7px 11px;
    border-radius: 999px;
    background: rgba(196,217,198,0.24);
    color: var(--sage-dark);
    font-size: 11.5px;
    font-weight: 500;
}

.du-video-empty {
    border-radius: 24px;
    padding: 28px;
    animation: duUp 0.55s ease 0.42s both;
}

.du-video-empty-title {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 8px;
}

.du-video-empty-copy {
    font-size: 14px;
    color: var(--muted);
    line-height: 1.75;
    margin-bottom: 18px;
}

.du-video-empty-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 22px;
    border-radius: 999px;
    background: var(--sage-dark);
    color: #FAF7F0;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: transform 0.2s, background 0.2s;
}

.du-video-empty-btn:hover {
    transform: translateY(-2px);
    background: #2f4b33;
}

@keyframes duUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 900px) {
    .du-wrap { padding: 28px 18px 60px; }
    .du-stats { grid-template-columns: 1fr 1fr; }
    .du-grid { grid-template-columns: 1fr; }
    .du-today { flex-direction: column; align-items: flex-start; }
    .du-poses { flex-wrap: wrap; }
    .du-progress-grid { grid-template-columns: 1fr; }
    .du-video-grid { grid-template-columns: 1fr; }
    .du-video-head { flex-direction: column; align-items: flex-start; }
    .du-header { flex-direction: column; align-items: flex-start; gap: 10px; }
}

@media (max-width: 480px) {
    .du-stats { grid-template-columns: 1fr; }
}
</style>

<div class="du-bg"></div>

<div class="du-wrap">
    <div class="du-header">
        <div>
            <div class="du-greeting" id="du-greeting">Good morning</div>
            <h1 class="du-title">Hello, <em>{{ Auth::user()->name }}</em></h1>
        </div>
        <div class="du-date">
            <strong id="du-day-num"></strong>
            <span id="du-day-str"></span>
        </div>
    </div>

    <div class="du-stats">
        <div class="du-stat du-glass">
            <div class="du-stat-label">Current Streak</div>
            <div class="du-stat-val">{{ $dashboardStats['streak_value'] }}</div>
            <div class="du-stat-sub">{{ $dashboardStats['streak_sub'] }}</div>
            <div class="du-stat-badge">{{ $dashboardStats['streak_badge'] }}</div>
        </div>
        <div class="du-stat du-glass">
            <div class="du-stat-label">Sessions Done</div>
            <div class="du-stat-val">{{ $dashboardStats['sessions_value'] }}</div>
            <div class="du-stat-sub">{{ $dashboardStats['sessions_sub'] }}</div>
            <div class="du-stat-badge">{{ $dashboardStats['sessions_badge'] }}</div>
        </div>
        <div class="du-stat du-glass">
            <div class="du-stat-label">Minutes Practiced</div>
            <div class="du-stat-val">{{ $dashboardStats['minutes_value'] }}</div>
            <div class="du-stat-sub">{{ $dashboardStats['minutes_sub'] }}</div>
            <div class="du-stat-badge">{{ $dashboardStats['minutes_badge'] }}</div>
        </div>
        <div class="du-stat du-glass">
            <div class="du-stat-label">Practice Score</div>
            <div class="du-stat-val">{{ $dashboardStats['score_value'] }}</div>
            <div class="du-stat-sub">{{ $dashboardStats['score_sub'] }}</div>
            <div class="du-stat-badge">{{ $dashboardStats['score_badge'] }}</div>
        </div>
    </div>

    <div class="du-grid">
        <a href="/preferences" class="du-card du-card-pref du-glass">
            <div class="du-card-icon">P</div>
            <div class="du-card-title">Set Preferences</div>
            <div class="du-card-desc">
                Customize your goals, available time, and practice level so the planner and recommendations stay relevant to you.
            </div>
            <div class="du-card-arrow">
                Customize plan <span class="du-arrow-dot">→</span>
            </div>
        </a>

        <a href="/plan" class="du-card du-card-plan du-glass">
            <div class="du-card-icon">Y</div>
            <div class="du-card-title">View Your Plan</div>
            <div class="du-card-desc">
                Open your personalized yoga and meditation schedule, check today's routine, and keep your progress moving forward.
            </div>
            <div class="du-card-arrow">
                Open plan <span class="du-arrow-dot">→</span>
            </div>
        </a>

        <div class="du-today">
            <div class="du-today-left">
                <div class="du-today-pill">Today's focus</div>
                <div class="du-today-title">{{ $videoRecommendations['yoga']['title'] ?? 'Build your personal practice' }}</div>
                <div class="du-today-sub">
                    @if($videoRecommendations)
                        {{ $videoRecommendations['yoga']['duration'] }} · {{ $videoRecommendations['level_label'] }} · {{ $videoRecommendations['goal_label'] }}
                    @else
                        Save your preferences to unlock goal-based practice suggestions.
                    @endif
                </div>
            </div>
            <div class="du-poses">
                <div class="du-pose">
                    <div class="du-pose-icon">{{ $dashboardStats['streak_value'] }}</div>
                    <div class="du-pose-name">Streak</div>
                </div>
                <div class="du-pose">
                    <div class="du-pose-icon">{{ $activityMetrics[0]['pct'] }}%</div>
                    <div class="du-pose-name">Weekly</div>
                </div>
                <div class="du-pose">
                    <div class="du-pose-icon">{{ $activityMetrics[1]['pct'] }}%</div>
                    <div class="du-pose-name">Monthly</div>
                </div>
            </div>
            <a href="/plan" class="du-today-btn">Open plan →</a>
        </div>
    </div>

    <div class="du-section-label">Your activity progress</div>
    <div class="du-progress-grid">
        @foreach($activityMetrics as $metric)
            <div class="du-progress-card du-glass">
                <div class="du-progress-head">
                    <div class="du-progress-name">{{ $metric['name'] }}</div>
                    <div class="du-progress-pct">{{ $metric['pct'] }}%</div>
                </div>
                <div class="du-bar-bg">
                    <div class="du-bar {{ $metric['bar_class'] }}" data-w="{{ $metric['pct'] }}"></div>
                </div>
                <div class="du-progress-meta">{{ $metric['meta'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="du-video-head">
        <div>
            <div class="du-section-label" style="margin: 0 0 10px;">Recommended videos</div>
            <div class="du-video-copy">
                @if($videoRecommendations)
                    Quick yoga and meditation picks matched to your saved goal of <strong>{{ $videoRecommendations['goal_label'] }}</strong> and shaped for a <strong>{{ $videoRecommendations['level_label'] }}</strong> pace.
                @else
                    Save your preferences to unlock friendlier video suggestions that better match your practice goal, energy, and schedule.
                @endif
            </div>
        </div>

        @if($videoRecommendations)
            <div class="du-video-badge">Personalized picks</div>
        @endif
    </div>

    @if($videoRecommendations)
        <div class="du-video-grid">
            <div class="du-video-card du-glass">
                <div class="du-video-frame">
                    <iframe
                        src="https://www.youtube-nocookie.com/embed/{{ $videoRecommendations['yoga']['youtube_id'] }}"
                        title="{{ $videoRecommendations['yoga']['title'] }}"
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                    ></iframe>
                </div>
                <div class="du-video-body">
                    <div class="du-video-label">Yoga recommendation</div>
                    <div class="du-video-title">{{ $videoRecommendations['yoga']['title'] }}</div>
                    <div class="du-video-sub">{{ $videoRecommendations['yoga']['subtitle'] }}</div>
                    <div class="du-video-meta">
                        <span class="du-video-chip">{{ $videoRecommendations['goal_label'] }}</span>
                        <span class="du-video-chip">{{ $videoRecommendations['level_label'] }}</span>
                        <span class="du-video-chip">{{ $videoRecommendations['yoga']['duration'] }}</span>
                    </div>
                </div>
            </div>

            <div class="du-video-card du-glass">
                <div class="du-video-frame">
                    <iframe
                        src="https://www.youtube-nocookie.com/embed/{{ $videoRecommendations['meditation']['youtube_id'] }}"
                        title="{{ $videoRecommendations['meditation']['title'] }}"
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                    ></iframe>
                </div>
                <div class="du-video-body">
                    <div class="du-video-label">Meditation recommendation</div>
                    <div class="du-video-title">{{ $videoRecommendations['meditation']['title'] }}</div>
                    <div class="du-video-sub">{{ $videoRecommendations['meditation']['subtitle'] }}</div>
                    <div class="du-video-meta">
                        <span class="du-video-chip">{{ $videoRecommendations['goal_label'] }}</span>
                        <span class="du-video-chip">Recovery support</span>
                        <span class="du-video-chip">{{ $videoRecommendations['meditation']['duration'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="du-video-empty du-glass">
            <div class="du-video-empty-title">Set your preferences to unlock guided videos</div>
            <div class="du-video-empty-copy">
                Once your goal and experience level are saved, the dashboard can surface friendlier yoga and meditation videos that feel much closer to what you actually need.
            </div>
            <a href="{{ route('preferences.create') }}" class="du-video-empty-btn">
                Set preferences <span>→</span>
            </a>
        </div>
    @endif
</div>

<script>
(function () {
    var d = new Date();
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var mons = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    document.getElementById('du-day-num').textContent = d.getDate();
    document.getElementById('du-day-str').textContent = days[d.getDay()] + ', ' + mons[d.getMonth()];
    var hr = d.getHours();
    document.getElementById('du-greeting').textContent =
        hr < 12 ? 'Good morning' : hr < 17 ? 'Good afternoon' : 'Good evening';
    setTimeout(function () {
        document.querySelectorAll('.du-bar[data-w]').forEach(function (el) {
            el.style.width = el.getAttribute('data-w') + '%';
        });
    }, 400);
})();
</script>
</x-app-layout>
