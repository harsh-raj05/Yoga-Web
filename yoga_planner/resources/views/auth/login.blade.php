<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign In — ZenFlow</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --sage: #7A9E7E; --sage-light: #C4D9C6; --sage-dark: #3E5E42;
    --clay: #C87941; --clay-light: #F0D5BC;
    --cream: #FAF7F0; --warm-white: #FFFEF9;
    --charcoal: #2A2A27; --muted: #6B6B63;
    --line: rgba(42,42,39,0.12); --error: #C0392B;
  }
  html, body { height: 100%; }
  body {
    font-family: 'DM Sans', sans-serif;
    background:
      linear-gradient(140deg, rgba(250,247,240,0.88), rgba(196,217,198,0.28) 48%, rgba(240,213,188,0.24)),
      url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=2000&q=80&auto=format&fit=crop') center center / cover fixed no-repeat;
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
  }

  /* ── LEFT PANEL ── */
  .left-panel {
    background:
      linear-gradient(135deg, rgba(42,42,39,0.62), rgba(62,94,66,0.82)),
      url('https://images.unsplash.com/photo-1518611012118-696072aa579a?w=1600&q=80&auto=format&fit=crop') center center / cover no-repeat;
    position: relative;
    display: flex; flex-direction: column;
    justify-content: space-between;
    padding: 48px 56px;
    overflow: hidden;
  }
  .left-panel::before {
    content: ''; position: absolute; top: -120px; right: -120px;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(196,217,198,0.24) 0%, transparent 65%);
    pointer-events: none;
  }
  .left-panel::after {
    content: ''; position: absolute; bottom: -80px; left: -80px;
    width: 360px; height: 360px;
    background: radial-gradient(circle, rgba(200,121,65,0.16) 0%, transparent 65%);
    pointer-events: none;
  }

  .panel-logo {
    font-family: 'Playfair Display', serif;
    font-size: 24px; font-weight: 700;
    color: var(--cream); letter-spacing: -0.5px;
    text-decoration: none; position: relative; z-index: 1;
  }
  .panel-logo span { color: #F0C090; font-style: italic; }

  .panel-center { position: relative; z-index: 1; }
  .panel-quote {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 400; font-style: italic;
    color: var(--cream); line-height: 1.3;
    letter-spacing: -0.5px; margin-bottom: 24px;
  }
  .panel-quote em { color: #F0C090; font-style: normal; }
  .panel-sub {
    font-size: 15px; font-weight: 300;
    color: rgba(250,247,240,0.6); line-height: 1.7; max-width: 340px;
  }

  .panel-stats {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 16px; position: relative; z-index: 1;
  }
  .p-stat {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px; padding: 20px 22px;
  }
  .p-stat-val {
    font-family: 'Playfair Display', serif;
    font-size: 28px; font-weight: 700;
    color: var(--cream); line-height: 1; margin-bottom: 4px;
  }
  .p-stat-label { font-size: 12px; color: rgba(250,247,240,0.55); }

  /* ── RIGHT PANEL ── */
  .right-panel {
    display: flex; align-items: center; justify-content: center;
    padding: 48px 56px;
    position: relative;
    background:
      linear-gradient(145deg, rgba(250,247,240,0.92), rgba(255,254,249,0.82)),
      url('https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=1400&q=80&auto=format&fit=crop') center center / cover no-repeat;
    overflow-y: auto;
  }
  .right-panel::before {
    content: ''; position: absolute; top: -60px; right: -60px;
    width: 340px; height: 340px;
    background: radial-gradient(circle, var(--sage-light) 0%, transparent 70%);
    opacity: 0.25; pointer-events: none;
  }
  .right-panel::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(120deg, rgba(255,254,249,0.24), rgba(255,254,249,0.08));
    pointer-events: none;
  }

  .form-card {
    width: 100%; max-width: 420px;
    position: relative; z-index: 1;
    background: rgba(255,254,249,0.74);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.72);
    border-radius: 30px;
    box-shadow: 0 28px 70px rgba(42,42,39,0.12);
    padding: 32px;
    animation: fadeUp 0.6s ease both;
  }
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .form-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--sage-light); color: var(--sage-dark);
    font-size: 11px; font-weight: 500;
    letter-spacing: 0.09em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 100px; margin-bottom: 20px;
  }
  .form-eyebrow::before {
    content: ''; width: 5px; height: 5px;
    background: var(--sage-dark); border-radius: 50%;
  }

  .form-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3vw, 38px);
    font-weight: 700; letter-spacing: -1px;
    color: var(--charcoal); line-height: 1.1; margin-bottom: 8px;
  }
  .form-title em { font-style: italic; color: var(--clay); }

  .form-sub {
    font-size: 14px; color: var(--muted);
    font-weight: 300; margin-bottom: 36px;
  }
  .form-sub a { color: var(--sage-dark); font-weight: 500; text-decoration: none; }
  .form-sub a:hover { text-decoration: underline; }

  /* Session Status */
  .session-status {
    background: rgba(122,158,126,0.1);
    border: 1px solid var(--sage-light);
    border-radius: 10px; padding: 12px 16px;
    font-size: 13px; color: var(--sage-dark); margin-bottom: 24px;
  }

  /* ── FIELDS ── */
  .field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 20px; }
  .field label {
    font-size: 12.5px; font-weight: 500;
    color: var(--charcoal); letter-spacing: 0.02em;
  }
  .input-wrap { position: relative; }
  .input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    font-size: 15px; pointer-events: none; opacity: 0.45; line-height: 1;
  }

  .field input[type="email"],
  .field input[type="password"],
  .field input[type="text"] {
    width: 100%;
    padding: 13px 14px 13px 42px;
    background: var(--warm-white);
    border: 1.5px solid var(--line);
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px; color: var(--charcoal);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    -webkit-appearance: none;
  }
  .field input:focus {
    border-color: var(--sage);
    box-shadow: 0 0 0 3px rgba(122,158,126,0.15);
  }
  .field input.has-error { border-color: var(--error); }
  .field input.has-error:focus { box-shadow: 0 0 0 3px rgba(192,57,43,0.1); }
  .field input::placeholder { color: rgba(107,107,99,0.4); }

  .toggle-pw {
    position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer;
    font-size: 14px; color: var(--muted); padding: 0; line-height: 1;
    transition: color 0.2s;
  }
  .toggle-pw:hover { color: var(--charcoal); }

  .field-error { font-size: 12px; color: var(--error); }

  /* ── META ROW ── */
  .form-meta {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 28px;
  }
  .remember-label {
    display: flex; align-items: center; gap: 8px; cursor: pointer;
  }
  .remember-label input[type="checkbox"] {
    width: 16px; height: 16px;
    border: 1.5px solid var(--line);
    border-radius: 4px; accent-color: var(--sage-dark); cursor: pointer;
  }
  .remember-label span { font-size: 13px; color: var(--muted); }
  .forgot-link {
    font-size: 13px; color: var(--sage-dark);
    text-decoration: none; font-weight: 500; transition: opacity 0.2s;
  }
  .forgot-link:hover { opacity: 0.7; }

  /* ── SUBMIT ── */
  .btn-submit {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    background: var(--charcoal); color: var(--cream);
    border: none; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px; font-weight: 500;
    padding: 15px 32px; border-radius: 100px;
    transition: background 0.25s, transform 0.2s;
    letter-spacing: -0.01em;
  }
  .btn-submit:hover { background: var(--sage-dark); transform: translateY(-2px); }
  .btn-submit:active { transform: translateY(0); }
  .btn-submit .arrow {
    display: inline-flex; align-items: center; justify-content: center;
    width: 24px; height: 24px;
    background: rgba(255,255,255,0.12); border-radius: 50%;
    font-size: 12px; transition: transform 0.2s;
  }
  .btn-submit:hover .arrow { transform: translateX(3px); }

  .divider {
    display: flex; align-items: center; gap: 14px;
    margin: 24px 0; color: var(--muted); font-size: 12px;
  }
  .divider::before, .divider::after {
    content: ''; flex: 1; height: 1px; background: var(--line);
  }

  .register-prompt { text-align: center; font-size: 13.5px; color: var(--muted); }
  .register-prompt a { color: var(--clay); font-weight: 500; text-decoration: none; }
  .register-prompt a:hover { text-decoration: underline; }

  /* ── RESPONSIVE ── */
  @media (max-width: 768px) {
    body { grid-template-columns: 1fr; overflow: auto; }
    .left-panel { display: none; }
    .right-panel { padding: 48px 28px; min-height: 100vh; align-items: flex-start; padding-top: 64px; }
    .form-card { padding: 24px; border-radius: 24px; }
  }
</style>
</head>
<body>

{{-- ── LEFT PANEL ── --}}
<div class="left-panel">
    <a href="/" class="panel-logo">Zen<span>Flow</span></a>

    <div class="panel-center">
        <div class="panel-quote">
            "Inhale the future,<br>exhale the <em>past.</em>"
        </div>
        <p class="panel-sub">
            Your personal yoga sanctuary awaits. Every session, every breath — designed entirely around you.
        </p>
    </div>

    <div class="panel-stats">
        <div class="p-stat">
            <div class="p-stat-val">200+</div>
            <div class="p-stat-label">Guided sessions</div>
        </div>
        <div class="p-stat">
            <div class="p-stat-val">12K</div>
            <div class="p-stat-label">Active practitioners</div>
        </div>
        <div class="p-stat">
            <div class="p-stat-val">98%</div>
            <div class="p-stat-label">Feel more balanced</div>
        </div>
        <div class="p-stat">
            <div class="p-stat-val">4.9★</div>
            <div class="p-stat-label">Average rating</div>
        </div>
    </div>
</div>

{{-- ── RIGHT PANEL ── --}}
<div class="right-panel">
    <div class="form-card">

        <div class="form-eyebrow">Welcome back</div>

        <h1 class="form-title">Sign in to your<br><em>practice</em></h1>
        <p class="form-sub">New here? <a href="{{ route('register') }}">Create a free account →</a></p>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="field">
                <label for="email">Email address</label>
                <div class="input-wrap">
                    <span class="input-icon">✉</span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        autocomplete="username"
                        required autofocus
                        class="{{ $errors->has('email') ? 'has-error' : '' }}"
                    />
                </div>
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="field">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                        class="{{ $errors->has('password') ? 'has-error' : '' }}"
                    />
                    <button type="button" class="toggle-pw" onclick="togglePw(this)" title="Toggle visibility">👁</button>
                </div>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="form-meta">
                <label class="remember-label" for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember">
                    <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                Sign in <span class="arrow">→</span>
            </button>

            <div class="divider">or</div>

            <div class="register-prompt">
                Don't have an account? <a href="{{ route('register') }}">Get started free</a>
            </div>

        </form>
    </div>
</div>

<script>
function togglePw(btn) {
    const input = btn.previousElementSibling;
    if (input.type === 'password') {
        input.type = 'text';
        btn.textContent = '🙈';
    } else {
        input.type = 'password';
        btn.textContent = '👁';
    }
}
</script>
</body>
</html>
