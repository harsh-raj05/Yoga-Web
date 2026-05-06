<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ZenFlow — Personalized Yoga Planner</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

  :root {
    --sage: #7A9E7E;
    --sage-light: #C4D9C6;
    --sage-dark: #3E5E42;
    --clay: #C87941;
    --clay-light: #F0D5BC;
    --cream: #FAF7F0;
    --warm-white: #FFFEF9;
    --charcoal: #2A2A27;
    --muted: #6B6B63;
    --line: rgba(42,42,39,0.12);
  }

  html, body { height: 100%; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    color: var(--charcoal);
    min-height: 100vh;
    overflow-x: hidden;
  }

  body::before {
    content: '';
    position: fixed;
    top: -80px; right: -80px;
    width: 520px; height: 520px;
    background: radial-gradient(circle, var(--sage-light) 0%, transparent 70%);
    opacity: 0.35;
    pointer-events: none;
    z-index: 0;
  }
  body::after {
    content: '';
    position: fixed;
    bottom: -100px; left: -100px;
    width: 480px; height: 480px;
    background: radial-gradient(circle, var(--clay-light) 0%, transparent 70%);
    opacity: 0.3;
    pointer-events: none;
    z-index: 0;
  }

  /* ── NAV ── */
  nav {
    position: fixed; top: 0; left: 0; right: 0;
    z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 24px 56px;
    background: rgba(250,247,240,0.85);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--line);
  }
  .nav-logo {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 700;
    color: var(--sage-dark); letter-spacing: -0.5px;
    text-decoration: none;
  }
  .nav-logo span { color: var(--clay); font-style: italic; }
  .nav-links {
    display: flex; align-items: center; gap: 40px; list-style: none;
  }
  .nav-links a {
    text-decoration: none; font-size: 13.5px; font-weight: 500;
    color: var(--muted); letter-spacing: 0.04em; text-transform: uppercase;
    transition: color 0.2s;
  }
  .nav-links a:hover { color: var(--charcoal); }
  .nav-cta {
    background: var(--charcoal) !important;
    color: var(--cream) !important;
    padding: 10px 24px; border-radius: 100px;
    transition: background 0.2s !important;
  }
  .nav-cta:hover { background: var(--sage-dark) !important; }

  /* ── HERO ── */
  .hero {
    position: relative; z-index: 1;
    min-height: 100vh;
    display: grid; grid-template-columns: 1fr 1fr;
    align-items: center;
    padding: 120px 56px 80px;
    gap: 64px;
    max-width: 1280px; margin: 0 auto;
  }
  .hero-left { display: flex; flex-direction: column; gap: 36px; }

  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--sage-light); color: var(--sage-dark);
    font-size: 11.5px; font-weight: 500;
    letter-spacing: 0.1em; text-transform: uppercase;
    padding: 8px 18px; border-radius: 100px; width: fit-content;
  }
  .eyebrow::before {
    content: ''; display: block;
    width: 6px; height: 6px;
    background: var(--sage-dark); border-radius: 50%;
  }

  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(44px, 5vw, 72px);
    font-weight: 700; line-height: 1.08;
    letter-spacing: -2px; color: var(--charcoal);
  }
  .hero-title em { font-style: italic; color: var(--clay); display: block; }

  .hero-desc {
    font-size: 17px; font-weight: 300;
    line-height: 1.75; color: var(--muted); max-width: 420px;
  }

  .hero-actions { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }

  .btn-primary {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--charcoal); color: var(--cream);
    text-decoration: none; font-size: 15px; font-weight: 500;
    padding: 16px 36px; border-radius: 100px;
    transition: background 0.25s, transform 0.2s;
  }
  .btn-primary:hover { background: var(--sage-dark); transform: translateY(-2px); }
  .btn-primary .arrow {
    display: inline-flex; align-items: center; justify-content: center;
    width: 26px; height: 26px;
    background: rgba(255,255,255,0.15); border-radius: 50%;
    font-size: 13px; transition: transform 0.2s;
  }
  .btn-primary:hover .arrow { transform: translateX(3px); }

  .btn-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    background: transparent; color: var(--charcoal);
    text-decoration: none; font-size: 14px; font-weight: 500;
    padding: 16px 28px; border-radius: 100px;
    border: 1.5px solid var(--line);
    transition: border-color 0.25s, background 0.2s;
  }
  .btn-ghost:hover { border-color: var(--charcoal); background: rgba(42,42,39,0.04); }

  .trust-bar { display: flex; align-items: center; gap: 20px; padding-top: 8px; }
  .avatars { display: flex; }
  .avatar {
    width: 36px; height: 36px; border-radius: 50%;
    border: 2.5px solid var(--cream); margin-left: -10px;
    background: var(--sage-light);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 500; color: var(--sage-dark);
  }
  .avatar:first-child { margin-left: 0; }
  .av2 { background: var(--clay-light); color: var(--clay); }
  .av3 { background: #E8E4F7; color: #5B4F9E; }
  .av4 { background: #E4F0E8; color: #3E6648; }
  .trust-text { font-size: 13px; color: var(--muted); }
  .trust-text strong { color: var(--charcoal); }

  /* ── HERO CARD ── */
  .hero-right {
    position: relative;
    display: flex; align-items: center; justify-content: center;
  }
  .hero-card {
    background: var(--warm-white);
    border: 1px solid var(--line); border-radius: 28px;
    padding: 40px; width: 100%; max-width: 420px;
    box-shadow: 0 32px 80px rgba(42,42,39,0.08);
    animation: floatCard 6s ease-in-out infinite;
  }
  @keyframes floatCard {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
  }
  .card-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--clay-light); color: var(--clay);
    font-size: 11px; font-weight: 500;
    text-transform: uppercase; letter-spacing: 0.08em;
    padding: 5px 12px; border-radius: 100px; margin-bottom: 20px;
  }
  .card-plan-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px; color: var(--charcoal); margin-bottom: 6px;
  }
  .card-plan-sub { font-size: 13px; color: var(--muted); margin-bottom: 28px; }

  .pose-grid {
    display: grid; grid-template-columns: 1fr 1fr 1fr;
    gap: 10px; margin-bottom: 28px;
  }
  .pose-item {
    background: var(--cream); border: 1px solid var(--line);
    border-radius: 14px; padding: 16px 10px; text-align: center;
    transition: border-color 0.2s;
  }
  .pose-item:hover { border-color: var(--sage); }
  .pose-icon { font-size: 24px; margin-bottom: 6px; }
  .pose-name { font-size: 11px; font-weight: 500; color: var(--muted); }

  .card-divider { height: 1px; background: var(--line); margin-bottom: 24px; }

  .card-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  .stat-box { background: var(--cream); border-radius: 14px; padding: 16px; }
  .stat-val {
    font-family: 'Playfair Display', serif;
    font-size: 26px; font-weight: 700; color: var(--charcoal);
    line-height: 1; margin-bottom: 4px;
  }
  .stat-label { font-size: 11.5px; color: var(--muted); font-weight: 400; }

  .float-badge {
    position: absolute; bottom: -18px; left: -28px;
    background: var(--warm-white); border: 1px solid var(--line);
    border-radius: 16px; padding: 14px 20px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: 0 8px 32px rgba(42,42,39,0.1);
    animation: floatBadge 5s ease-in-out infinite 1s;
  }
  @keyframes floatBadge {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
  }
  .badge-dot {
    width: 36px; height: 36px; background: var(--sage-light);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center; font-size: 16px;
  }
  .badge-text { font-size: 12px; color: var(--charcoal); }
  .badge-text strong { display: block; font-weight: 500; }
  .badge-text span { color: var(--muted); font-size: 11px; }

  /* ── AUTHENTICATED DASHBOARD BTN ── */
  .dashboard-hero { display: flex; flex-direction: column; gap: 20px; }
  .dashboard-welcome {
    font-family: 'Playfair Display', serif;
    font-size: 18px; color: var(--muted); font-style: italic;
  }

  /* ── FEATURES STRIP ── */
  .features-strip {
    position: relative; z-index: 1;
    background: var(--charcoal);
    padding: 20px 56px;
    display: flex; align-items: center; justify-content: center;
    gap: 56px; flex-wrap: wrap;
  }
  .feature-item {
    display: flex; align-items: center; gap: 10px;
    color: rgba(250,247,240,0.7); font-size: 13px; font-weight: 400;
  }
  .feature-dot { width: 6px; height: 6px; background: var(--clay); border-radius: 50%; flex-shrink: 0; }

  /* ── FEATURE CARDS ── */
  .section {
    position: relative; z-index: 1;
    max-width: 1280px; margin: 0 auto; padding: 100px 56px;
  }
  .section-label {
    font-size: 11.5px; font-weight: 500;
    text-transform: uppercase; letter-spacing: 0.1em;
    color: var(--clay); margin-bottom: 16px;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 52px); font-weight: 700;
    line-height: 1.1; letter-spacing: -1.5px;
    color: var(--charcoal); max-width: 600px; margin-bottom: 64px;
  }
  .section-title em { font-style: italic; color: var(--sage-dark); }

  .cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }

  .feat-card {
    background: var(--warm-white); border: 1px solid var(--line);
    border-radius: 20px; padding: 36px 32px;
    transition: transform 0.25s, box-shadow 0.25s;
  }
  .feat-card:hover { transform: translateY(-6px); box-shadow: 0 24px 60px rgba(42,42,39,0.09); }
  .feat-card.accent { background: var(--charcoal); border-color: var(--charcoal); }
  .feat-icon {
    width: 52px; height: 52px; background: var(--cream);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; margin-bottom: 24px; border: 1px solid var(--line);
  }
  .feat-card.accent .feat-icon { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.1); }
  .feat-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 700;
    color: var(--charcoal); margin-bottom: 12px; line-height: 1.3;
  }
  .feat-card.accent .feat-title { color: var(--cream); }
  .feat-desc { font-size: 14px; color: var(--muted); line-height: 1.7; font-weight: 300; }
  .feat-card.accent .feat-desc { color: rgba(250,247,240,0.6); }

  /* ── CTA ── */
  .cta-section {
    position: relative; z-index: 1;
    max-width: 1280px; margin: 0 auto; padding: 0 56px 100px;
  }
  .cta-box {
    background: var(--sage-dark); border-radius: 28px;
    padding: 80px 72px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 48px; overflow: hidden; position: relative;
  }
  .cta-box::before {
    content: ''; position: absolute;
    top: -100px; right: -100px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
    pointer-events: none;
  }
  .cta-left { max-width: 560px; }
  .cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 48px); font-weight: 700;
    line-height: 1.1; letter-spacing: -1.5px;
    color: var(--cream); margin-bottom: 18px;
  }
  .cta-title em { font-style: italic; color: var(--clay-light); }
  .cta-desc { font-size: 16px; color: rgba(250,247,240,0.65); font-weight: 300; line-height: 1.7; }
  .cta-buttons { display: flex; flex-direction: column; gap: 12px; flex-shrink: 0; }
  .btn-light {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    background: var(--cream); color: var(--charcoal);
    text-decoration: none; font-size: 15px; font-weight: 500;
    padding: 16px 36px; border-radius: 100px;
    transition: background 0.2s, transform 0.2s; white-space: nowrap;
  }
  .btn-light:hover { background: #fff; transform: translateY(-2px); }
  .btn-outline-light {
    display: inline-flex; align-items: center; justify-content: center;
    background: transparent; color: var(--cream);
    text-decoration: none; font-size: 14px; font-weight: 400;
    padding: 16px 36px; border-radius: 100px;
    border: 1.5px solid rgba(255,255,255,0.25);
    transition: border-color 0.2s; white-space: nowrap;
  }
  .btn-outline-light:hover { border-color: rgba(255,255,255,0.6); }

  /* ── FOOTER ── */
  footer {
    position: relative; z-index: 1;
    border-top: 1px solid var(--line);
    padding: 32px 56px;
    display: flex; align-items: center; justify-content: space-between;
    max-width: 1280px; margin: 0 auto;
  }
  .footer-logo {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: var(--sage-dark);
    text-decoration: none;
  }
  .footer-logo span { color: var(--clay); font-style: italic; }
  .footer-copy { font-size: 13px; color: var(--muted); }
  .footer-links { display: flex; gap: 28px; }
  .footer-links a { font-size: 13px; color: var(--muted); text-decoration: none; }
  .footer-links a:hover { color: var(--charcoal); }

  /* ── ANIMATIONS ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .hero-left > * { animation: fadeUp 0.7s ease both; }
  .hero-left > *:nth-child(1) { animation-delay: 0.1s; }
  .hero-left > *:nth-child(2) { animation-delay: 0.22s; }
  .hero-left > *:nth-child(3) { animation-delay: 0.34s; }
  .hero-left > *:nth-child(4) { animation-delay: 0.46s; }
  .hero-left > *:nth-child(5) { animation-delay: 0.56s; }
  .hero-right { animation: fadeUp 0.8s ease 0.3s both; }

  @media (max-width: 900px) {
    nav { padding: 20px 24px; }
    .nav-links { display: none; }
    .hero { grid-template-columns: 1fr; padding: 100px 24px 60px; gap: 48px; }
    .hero-right { display: none; }
    .features-strip { padding: 20px 24px; gap: 24px; }
    .section { padding: 64px 24px; }
    .cards-grid { grid-template-columns: 1fr; }
    .cta-section { padding: 0 24px 64px; }
    .cta-box { flex-direction: column; padding: 48px 36px; }
    .cta-buttons { flex-direction: row; }
    footer { flex-direction: column; gap: 16px; text-align: center; padding: 32px 24px; }
    .footer-links { flex-wrap: wrap; justify-content: center; }
  }
</style>
</head>
<body>

{{-- ── NAV ── --}}
<nav>
    <a href="/" class="nav-logo">Zen<span>Flow</span></a>
    <ul class="nav-links">
        <li><a href="#">Programs</a></li>
        <li><a href="#">For You</a></li>
        <li><a href="#">Community</a></li>
        @auth
            <li><a href="/dashboard" class="nav-cta">Dashboard →</a></li>
        @else
            <li><a href="/register" class="nav-cta">Get Started</a></li>
        @endauth
    </ul>
</nav>

{{-- ── HERO ── --}}
<div class="hero">
    <div class="hero-left">

        <div class="eyebrow">Personalized Yoga & Meditation</div>

        <h1 class="hero-title">
            Your practice,<br>
            <em>perfectly tailored</em>
            to you.
        </h1>

        <p class="hero-desc">
            Adaptive yoga plans built around your body, goals, and schedule.
            From morning flows to deep evening meditation — we guide every breath.
        </p>

        @auth
            <div class="dashboard-hero">
                <div class="dashboard-welcome">Welcome back — your mat awaits ✨</div>
                <div class="hero-actions">
                    <a href="/dashboard" class="btn-primary">
                        Go to Dashboard
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        @else
            <div class="hero-actions">
                <a href="/register" class="btn-primary">
                    Begin your journey
                    <span class="arrow">→</span>
                </a>
                <a href="/login" class="btn-ghost">Sign in</a>
            </div>
        @endauth

        <div class="trust-bar">
            <div class="avatars">
                <div class="avatar">KR</div>
                <div class="avatar av2">ML</div>
                <div class="avatar av3">PS</div>
                <div class="avatar av4">TN</div>
            </div>
            <div class="trust-text">Joined by <strong>12,000+</strong> practitioners worldwide</div>
        </div>

    </div>

    <div class="hero-right">
        <div class="hero-card">
            <div class="card-tag">✦ Today's Plan</div>
            <div class="card-plan-title">Morning Vinyasa Flow</div>
            <div class="card-plan-sub">45 min · Intermediate · Full Body</div>
            <div class="pose-grid">
                <div class="pose-item">
                    <div class="pose-icon">🧘</div>
                    <div class="pose-name">Warrior I</div>
                </div>
                <div class="pose-item">
                    <div class="pose-icon">🌿</div>
                    <div class="pose-name">Tree Pose</div>
                </div>
                <div class="pose-item">
                    <div class="pose-icon">🌙</div>
                    <div class="pose-name">Child's Pose</div>
                </div>
            </div>
            <div class="card-divider"></div>
            <div class="card-stats">
                <div class="stat-box">
                    <div class="stat-val">28</div>
                    <div class="stat-label">Day streak 🔥</div>
                </div>
                <div class="stat-box">
                    <div class="stat-val">94%</div>
                    <div class="stat-label">Goal progress</div>
                </div>
            </div>
        </div>
        <div class="float-badge">
            <div class="badge-dot">🌱</div>
            <div class="badge-text">
                <strong>Mindfulness Score</strong>
                <span>Up 18% this week</span>
            </div>
        </div>
    </div>
</div>

{{-- ── FEATURES STRIP ── --}}
<div class="features-strip">
    <div class="feature-item"><div class="feature-dot"></div>Adaptive AI planning</div>
    <div class="feature-item"><div class="feature-dot"></div>200+ guided sessions</div>
    <div class="feature-item"><div class="feature-dot"></div>Breath & mindfulness tracking</div>
    <div class="feature-item"><div class="feature-dot"></div>Expert instructors</div>
    <div class="feature-item"><div class="feature-dot"></div>All levels welcome</div>
</div>

{{-- ── FEATURE CARDS ── --}}
<div class="section">
    <div class="section-label">Why practitioners love us</div>
    <div class="section-title">Built for your <em>unique journey</em></div>
    <div class="cards-grid">
        <div class="feat-card">
            <div class="feat-icon">🧠</div>
            <div class="feat-title">Intelligent Adaptation</div>
            <div class="feat-desc">Your plan evolves daily based on energy levels, goals, and progress — never static, always optimized for where you are today.</div>
        </div>
        <div class="feat-card accent">
            <div class="feat-icon">🌿</div>
            <div class="feat-title">Holistic Wellness</div>
            <div class="feat-desc">From power vinyasa to restorative yin and guided meditation — a complete mind-body system in one beautifully designed app.</div>
        </div>
        <div class="feat-card">
            <div class="feat-icon">📈</div>
            <div class="feat-title">Progress You Can See</div>
            <div class="feat-desc">Detailed insights on flexibility, consistency, and mindfulness. Track your transformation week by week with clarity.</div>
        </div>
    </div>
</div>

{{-- ── CTA ── --}}
<div class="cta-section">
    <div class="cta-box">
        <div class="cta-left">
            <div class="cta-title">Ready to find your <em>flow?</em></div>
            <div class="cta-desc">Join thousands who've transformed their wellbeing. Start your personalized yoga journey today — free for 14 days.</div>
        </div>
        <div class="cta-buttons">
            @auth
                <a href="/dashboard" class="btn-light">Go to Dashboard →</a>
            @else
                <a href="/register" class="btn-light">Create free account →</a>
                <a href="/login" class="btn-outline-light">Sign in to continue</a>
            @endauth
        </div>
    </div>
</div>

{{-- ── FOOTER ── --}}
<footer>
    <a href="/" class="footer-logo">Zen<span>Flow</span></a>
    <div class="footer-copy">© {{ date('Y') }} ZenFlow · Stay healthy · Stay mindful</div>
    <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Support</a>
    </div>
</footer>

</body>
</html>