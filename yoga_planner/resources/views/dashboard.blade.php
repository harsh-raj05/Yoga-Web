<x-app-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --sage-light: #C4D9C6;
    --sage-dark:  #3E5E42;
    --clay:       #C87941;
    --clay-light: #F0D5BC;
    --warm-white: #FFFEF9;
    --charcoal:   #2A2A27;
    --muted:      #6B6B63;
    --line:       rgba(42,42,39,0.12);
    --glass:      rgba(255,255,255,0.72);
    --glass-border: rgba(255,255,255,0.55);
}

/* FULL-PAGE BACKGROUND */
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
    position: absolute; inset: 0;
    background: linear-gradient(
        160deg,
        rgba(250,247,240,0.83) 0%,
        rgba(196,217,198,0.55) 45%,
        rgba(240,213,188,0.45) 100%
    );
}

/* MAIN CONTENT */
.du-wrap {
    font-family: 'DM Sans', sans-serif;
    position: relative;
    z-index: 1;
    max-width: 1100px;
    margin: 0 auto;
    padding: 48px 40px 80px;
    color: var(--charcoal);
}

/* HEADER */
.du-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 40px;
    animation: duUp 0.55s ease both;
}
.du-greeting { font-size: 13px; color: var(--muted); margin-bottom: 6px; }
.du-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(26px, 3.5vw, 44px);
    font-weight: 700; letter-spacing: -1.5px;
    color: var(--charcoal); line-height: 1.1;
}
.du-title em { font-style: italic; color: var(--sage-dark); }
.du-date { text-align: right; font-size: 13px; color: var(--muted); }
.du-date strong {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 700; color: var(--charcoal);
}

/* GLASS UTILITY */
.du-glass {
    background: var(--glass);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid var(--glass-border);
    box-shadow: 0 8px 32px rgba(42,42,39,0.08);
}

/* STATS */
.du-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-bottom: 28px;
    animation: duUp 0.55s ease 0.08s both;
}
.du-stat {
    border-radius: 20px; padding: 22px 20px;
    transition: transform 0.22s, box-shadow 0.22s;
}
.du-stat:hover { transform: translateY(-5px); box-shadow: 0 20px 48px rgba(42,42,39,0.12); }
.du-stat-label {
    font-size: 10.5px; color: var(--muted); font-weight: 500;
    text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 8px;
}
.du-stat-val {
    font-family: 'Playfair Display', serif;
    font-size: 30px; font-weight: 700; color: var(--charcoal); line-height: 1; margin-bottom: 4px;
}
.du-stat-sub  { font-size: 11.5px; color: var(--muted); font-weight: 300; }
.du-stat-badge {
    display: inline-flex; align-items: center; gap: 4px;
    background: rgba(62,94,66,0.12); color: var(--sage-dark);
    font-size: 10.5px; font-weight: 500;
    padding: 3px 9px; border-radius: 100px; margin-top: 8px;
}

/* ACTION GRID */
.du-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 18px; animation: duUp 0.55s ease 0.16s both;
}

/* ACTION CARDS */
.du-card {
    border-radius: 22px; padding: 32px;
    text-decoration: none; color: inherit;
    display: flex; flex-direction: column;
    transition: transform 0.25s, box-shadow 0.25s;
    position: relative; overflow: hidden;
}
.du-card::before {
    content: ''; position: absolute; top: -60px; right: -60px;
    width: 200px; height: 200px; border-radius: 50%;
    transition: transform 0.4s; pointer-events: none;
}
.du-card-pref::before { background: radial-gradient(circle, rgba(200,121,65,0.15) 0%, transparent 70%); }
.du-card-plan::before { background: radial-gradient(circle, rgba(62,94,66,0.15)   0%, transparent 70%); }
.du-card:hover { transform: translateY(-7px); box-shadow: 0 28px 64px rgba(42,42,39,0.14); }
.du-card:hover::before { transform: scale(1.5); }

.du-card-icon {
    width: 52px; height: 52px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; margin-bottom: 18px; position: relative; z-index: 1;
}
.du-card-pref .du-card-icon { background: rgba(240,213,188,0.75); }
.du-card-plan .du-card-icon { background: rgba(196,217,198,0.75); }

.du-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 700; color: var(--charcoal);
    margin-bottom: 8px; position: relative; z-index: 1;
}
.du-card-desc {
    font-size: 14px; color: var(--muted); font-weight: 300;
    line-height: 1.65; flex: 1; position: relative; z-index: 1; margin-bottom: 20px;
}
.du-card-arrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 500;
    position: relative; z-index: 1; transition: gap 0.2s;
}
.du-card-pref .du-card-arrow { color: var(--clay); }
.du-card-plan .du-card-arrow { color: var(--sage-dark); }
.du-card:hover .du-card-arrow { gap: 14px; }
.du-arrow-dot {
    width: 28px; height: 28px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; font-size: 13px;
}
.du-card-pref .du-arrow-dot { background: rgba(240,213,188,0.85); color: var(--clay); }
.du-card-plan .du-arrow-dot { background: rgba(196,217,198,0.85); color: var(--sage-dark); }

/* TODAY BANNER */
.du-today {
    grid-column: 1 / -1;
    background: rgba(42,42,39,0.88);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 22px; padding: 30px 36px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 24px; overflow: hidden; position: relative;
    box-shadow: 0 12px 48px rgba(42,42,39,0.2);
}
.du-today::before {
    content: ''; position: absolute; top: -80px; right: -80px;
    width: 320px; height: 320px;
    background: radial-gradient(circle, rgba(196,217,198,0.09) 0%, transparent 70%);
    pointer-events: none;
}
.du-today-left  { position: relative; z-index: 1; }
.du-today-pill {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14);
    color: rgba(250,247,240,0.65);
    font-size: 10.5px; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase;
    padding: 5px 12px; border-radius: 100px; margin-bottom: 12px;
}
.du-today-pill::before { content:''; width:5px; height:5px; background:#F0C090; border-radius:50%; }
.du-today-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 700; color: #FAF7F0;
    margin-bottom: 4px; letter-spacing: -0.5px;
}
.du-today-sub { font-size: 13px; color: rgba(250,247,240,0.5); font-weight: 300; }
.du-poses { display: flex; gap: 10px; position: relative; z-index: 1; }
.du-pose {
    background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px; padding: 12px 15px; text-align: center; min-width: 82px;
}
.du-pose-icon { font-size: 18px; margin-bottom: 4px; }
.du-pose-name { font-size: 10.5px; color: rgba(250,247,240,0.55); }
.du-today-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: #FAF7F0; color: var(--charcoal);
    text-decoration: none; font-size: 14px; font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    padding: 13px 26px; border-radius: 100px;
    transition: background 0.2s, transform 0.2s;
    white-space: nowrap; position: relative; z-index: 1; flex-shrink: 0;
}
.du-today-btn:hover { background: #fff; transform: translateY(-2px); }

/* PROGRESS */
.du-section-label {
    font-size: 11px; font-weight: 500;
    text-transform: uppercase; letter-spacing: 0.09em;
    color: var(--muted); margin: 30px 0 14px;
    animation: duUp 0.55s ease 0.24s both;
}
.du-progress-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 16px; animation: duUp 0.55s ease 0.3s both;
}
.du-progress-card { border-radius: 18px; padding: 22px; }
.du-progress-head {
    display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;
}
.du-progress-name { font-size: 13.5px; font-weight: 500; color: var(--charcoal); }
.du-progress-pct  { font-size: 13px; color: var(--muted); }
.du-bar-bg {
    height: 6px; background: rgba(42,42,39,0.1);
    border-radius: 100px; overflow: hidden; margin-bottom: 10px;
}
.du-bar { height: 100%; border-radius: 100px; background: var(--sage-dark); width: 0%; transition: width 1.2s ease; }
.du-bar.clay { background: var(--clay); }
.du-bar.mid  { background: #8B7FBE; }
.du-progress-meta { font-size: 12px; color: var(--muted); font-weight: 300; }

@keyframes duUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 900px) {
    .du-wrap          { padding: 28px 18px 60px; }
    .du-stats         { grid-template-columns: 1fr 1fr; }
    .du-grid          { grid-template-columns: 1fr; }
    .du-today         { flex-direction: column; align-items: flex-start; }
    .du-poses         { flex-wrap: wrap; }
    .du-progress-grid { grid-template-columns: 1fr; }
    .du-header        { flex-direction: column; align-items: flex-start; gap: 10px; }
}
@media (max-width: 480px) {
    .du-stats { grid-template-columns: 1fr; }
}
</style>

{{-- Fixed background image --}}
<div class="du-bg"></div>

<div class="du-wrap">

    {{-- HEADER --}}
    <div class="du-header">
        <div>
            <div class="du-greeting" id="du-greeting">Good morning ☀️</div>
            <h1 class="du-title">Hello, <em>{{ Auth::user()->name }}</em> 👋</h1>
        </div>
        <div class="du-date">
            <strong id="du-day-num"></strong>
            <span id="du-day-str"></span>
        </div>
    </div>

    {{-- STATS --}}
    <div class="du-stats">
        <div class="du-stat du-glass">
            <div class="du-stat-label">Day Streak</div>
            <div class="du-stat-val">28</div>
            <div class="du-stat-sub">consecutive days</div>
            <div class="du-stat-badge">🔥 Personal best</div>
        </div>
        <div class="du-stat du-glass">
            <div class="du-stat-label">Sessions Done</div>
            <div class="du-stat-val">142</div>
            <div class="du-stat-sub">total sessions</div>
            <div class="du-stat-badge">↑ 6 this week</div>
        </div>
        <div class="du-stat du-glass">
            <div class="du-stat-label">Minutes Practiced</div>
            <div class="du-stat-val">38h</div>
            <div class="du-stat-sub">total mindful time</div>
            <div class="du-stat-badge">↑ 12% this month</div>
        </div>
        <div class="du-stat du-glass">
            <div class="du-stat-label">Mindfulness Score</div>
            <div class="du-stat-val">94%</div>
            <div class="du-stat-sub">weekly average</div>
            <div class="du-stat-badge">↑ 18% this week</div>
        </div>
    </div>

    {{-- ACTION CARDS --}}
    <div class="du-grid">

        <a href="/preferences" class="du-card du-card-pref du-glass">
            <div class="du-card-icon">⚙️</div>
            <div class="du-card-title">Set Preferences</div>
            <div class="du-card-desc">
                Customize your experience. Set your goals, availability,
                intensity, and focus areas for a plan built entirely around you.
            </div>
            <div class="du-card-arrow">
                Customize plan <span class="du-arrow-dot">→</span>
            </div>
        </a>

        <a href="/plan" class="du-card du-card-plan du-glass">
            <div class="du-card-icon">📋</div>
            <div class="du-card-title">View Your Plan</div>
            <div class="du-card-desc">
                Your full personalized yoga and meditation schedule. See today's
                sessions, this week's flow, and upcoming milestones.
            </div>
            <div class="du-card-arrow">
                Open plan <span class="du-arrow-dot">→</span>
            </div>
        </a>

        {{-- Today banner --}}
        <div class="du-today">
            <div class="du-today-left">
                <div class="du-today-pill">Today's session</div>
                <div class="du-today-title">Morning Vinyasa Flow</div>
                <div class="du-today-sub">45 min · Intermediate · Full Body</div>
            </div>
            <div class="du-poses">
                <div class="du-pose">
                    <div class="du-pose-icon">🧘</div>
                    <div class="du-pose-name">Warrior I</div>
                </div>
                <div class="du-pose">
                    <div class="du-pose-icon">🌿</div>
                    <div class="du-pose-name">Tree Pose</div>
                </div>
                <div class="du-pose">
                    <div class="du-pose-icon">🌙</div>
                    <div class="du-pose-name">Child's Pose</div>
                </div>
            </div>
            <a href="/plan" class="du-today-btn">Begin session →</a>
        </div>

    </div>

    {{-- PROGRESS --}}
    <div class="du-section-label">Your progress this week</div>
    <div class="du-progress-grid">
        <div class="du-progress-card du-glass">
            <div class="du-progress-head">
                <div class="du-progress-name">Flexibility</div>
                <div class="du-progress-pct">78%</div>
            </div>
            <div class="du-bar-bg"><div class="du-bar" data-w="78"></div></div>
            <div class="du-progress-meta">↑ 4% from last week</div>
        </div>
        <div class="du-progress-card du-glass">
            <div class="du-progress-head">
                <div class="du-progress-name">Consistency</div>
                <div class="du-progress-pct">92%</div>
            </div>
            <div class="du-bar-bg"><div class="du-bar clay" data-w="92"></div></div>
            <div class="du-progress-meta">6 of 7 days completed</div>
        </div>
        <div class="du-progress-card du-glass">
            <div class="du-progress-head">
                <div class="du-progress-name">Mindfulness</div>
                <div class="du-progress-pct">65%</div>
            </div>
            <div class="du-bar-bg"><div class="du-bar mid" data-w="65"></div></div>
            <div class="du-progress-meta">↑ 18% this month</div>
        </div>
    </div>

</div>

<script>
(function () {
    var d    = new Date();
    var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    var mons = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    document.getElementById('du-day-num').textContent = d.getDate();
    document.getElementById('du-day-str').textContent = days[d.getDay()] + ', ' + mons[d.getMonth()];
    var hr = d.getHours();
    document.getElementById('du-greeting').textContent =
        hr < 12 ? 'Good morning ☀️' : hr < 17 ? 'Good afternoon 🌤️' : 'Good evening 🌙';
    setTimeout(function () {
        document.querySelectorAll('.du-bar[data-w]').forEach(function (el) {
            el.style.width = el.getAttribute('data-w') + '%';
        });
    }, 400);
})();
</script>

</x-app-layout>