<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account — ZenFlow</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --sage: #7A9E7E; --sage-light: #C4D9C6; --sage-dark: #3E5E42;
    --clay: #C87941; --clay-light: #F0D5BC;
    --cream: #FAF7F0; --warm-white: #FFFEF9;
    --charcoal: #2A2A27; --muted: #6B6B63;
    --line: rgba(42,42,39,0.12); --error: #C0392B; --success: #2E7D52;
  }
  html, body { height: 100%; }
  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
  }

  /* ── LEFT PANEL ── */
  .left-panel {
    background: var(--charcoal);
    position: relative;
    display: flex; flex-direction: column;
    justify-content: space-between;
    padding: 48px 56px;
    overflow: hidden;
  }
  .left-panel::before {
    content: ''; position: absolute; top: -100px; left: -100px;
    width: 480px; height: 480px;
    background: radial-gradient(circle, rgba(200,121,65,0.14) 0%, transparent 65%);
    pointer-events: none;
  }
  .left-panel::after {
    content: ''; position: absolute; bottom: -80px; right: -80px;
    width: 380px; height: 380px;
    background: radial-gradient(circle, rgba(122,158,126,0.12) 0%, transparent 65%);
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

  .panel-tagline {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    color: rgba(250,247,240,0.7);
    font-size: 11px; font-weight: 500;
    letter-spacing: 0.09em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 100px; margin-bottom: 24px;
  }
  .panel-tagline::before {
    content: ''; width: 5px; height: 5px;
    background: #F0C090; border-radius: 50%;
  }

  .panel-quote {
    font-family: 'Playfair Display', serif;
    font-size: clamp(26px, 2.8vw, 40px);
    font-weight: 700;
    color: var(--cream); line-height: 1.2;
    letter-spacing: -1px; margin-bottom: 24px;
  }
  .panel-quote em { font-style: italic; color: #F0C090; }

  .panel-sub {
    font-size: 14px; font-weight: 300;
    color: rgba(250,247,240,0.55); line-height: 1.75; max-width: 340px;
  }

  .benefits { position: relative; z-index: 1; display: flex; flex-direction: column; gap: 14px; }
  .benefit-item { display: flex; align-items: flex-start; gap: 14px; }
  .benefit-icon {
    width: 38px; height: 38px; flex-shrink: 0;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
  }
  .benefit-text strong {
    display: block; font-size: 13px; font-weight: 500;
    color: var(--cream); margin-bottom: 2px;
  }
  .benefit-text span { font-size: 12px; color: rgba(250,247,240,0.5); font-weight: 300; }

  /* ── RIGHT PANEL ── */
  .right-panel {
    display: flex; align-items: center; justify-content: center;
    padding: 40px 56px;
    position: relative; background: var(--cream);
    overflow-y: auto;
  }
  .right-panel::before {
    content: ''; position: absolute; bottom: -60px; right: -60px;
    width: 340px; height: 340px;
    background: radial-gradient(circle, var(--clay-light) 0%, transparent 70%);
    opacity: 0.2; pointer-events: none;
  }

  .form-card {
    width: 100%; max-width: 440px;
    position: relative; z-index: 1;
    animation: fadeUp 0.6s ease both;
  }
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .form-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--clay-light); color: var(--clay);
    font-size: 11px; font-weight: 500;
    letter-spacing: 0.09em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 100px; margin-bottom: 20px;
  }
  .form-eyebrow::before { content: '✦'; font-size: 9px; }

  .form-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(26px, 2.8vw, 36px);
    font-weight: 700; letter-spacing: -1px;
    color: var(--charcoal); line-height: 1.1; margin-bottom: 8px;
  }
  .form-title em { font-style: italic; color: var(--sage-dark); }

  .form-sub {
    font-size: 14px; color: var(--muted);
    font-weight: 300; margin-bottom: 28px;
  }
  .form-sub a { color: var(--sage-dark); font-weight: 500; text-decoration: none; }
  .form-sub a:hover { text-decoration: underline; }

  /* ── TWO-COL ROW ── */
  .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

  /* ── FIELDS ── */
  .field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
  .field label {
    font-size: 12px; font-weight: 500;
    color: var(--charcoal); letter-spacing: 0.02em;
  }
  .input-wrap { position: relative; }
  .input-icon {
    position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
    font-size: 14px; pointer-events: none; opacity: 0.4; line-height: 1;
  }
  .field input {
    width: 100%;
    padding: 12px 13px 12px 40px;
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
  .field input::placeholder { color: rgba(107,107,99,0.38); }

  .toggle-pw {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer;
    font-size: 13px; color: var(--muted); padding: 0; line-height: 1;
    transition: color 0.2s;
  }
  .toggle-pw:hover { color: var(--charcoal); }

  .field-error { font-size: 12px; color: var(--error); }

  /* ── PASSWORD STRENGTH ── */
  .pw-strength { margin-top: 8px; }
  .strength-bar { display: flex; gap: 4px; margin-bottom: 5px; }
  .strength-seg {
    flex: 1; height: 3px; border-radius: 100px;
    background: var(--line); transition: background 0.3s;
  }
  .strength-label { font-size: 11px; color: var(--muted); }

  /* ── TERMS ── */
  .terms-row {
    display: flex; align-items: flex-start; gap: 10px;
    margin-bottom: 22px; margin-top: 4px;
  }
  .terms-row input[type="checkbox"] {
    width: 16px; height: 16px; margin-top: 2px; flex-shrink: 0;
    accent-color: var(--sage-dark); cursor: pointer;
  }
  .terms-row span { font-size: 12.5px; color: var(--muted); line-height: 1.6; }
  .terms-row a { color: var(--sage-dark); font-weight: 500; text-decoration: none; }
  .terms-row a:hover { text-decoration: underline; }

  /* ── SUBMIT ── */
  .btn-submit {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    background: var(--sage-dark); color: var(--cream);
    border: none; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px; font-weight: 500;
    padding: 15px 32px; border-radius: 100px;
    transition: background 0.25s, transform 0.2s;
    letter-spacing: -0.01em;
  }
  .btn-submit:hover { background: var(--charcoal); transform: translateY(-2px); }
  .btn-submit:active { transform: translateY(0); }
  .btn-submit .arrow {
    display: inline-flex; align-items: center; justify-content: center;
    width: 24px; height: 24px;
    background: rgba(255,255,255,0.12); border-radius: 50%;
    font-size: 12px; transition: transform 0.2s;
  }
  .btn-submit:hover .arrow { transform: translateX(3px); }

  .free-badge {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    font-size: 11.5px; color: var(--muted); margin-top: 14px;
  }
  .free-badge::before, .free-badge::after {
    content: ''; flex: 1; height: 1px; background: var(--line);
  }

  .login-prompt { text-align: center; font-size: 13px; color: var(--muted); margin-top: 16px; }
  .login-prompt a { color: var(--clay); font-weight: 500; text-decoration: none; }
  .login-prompt a:hover { text-decoration: underline; }

  /* ── RESPONSIVE ── */
  @media (max-width: 768px) {
    body { grid-template-columns: 1fr; overflow: auto; }
    .left-panel { display: none; }
    .right-panel { padding: 48px 28px; min-height: 100vh; align-items: flex-start; padding-top: 64px; }
    .field-row { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

{{-- ── LEFT PANEL ── --}}
<div class="left-panel">
    <a href="/" class="panel-logo">Zen<span>Flow</span></a>

    <div class="panel-center">
        <div class="panel-tagline">Start free · No credit card</div>
        <div class="panel-quote">
            Begin your<br><em>transformation</em><br>today.
        </div>
        <p class="panel-sub">
            Join thousands of practitioners who've found balance, strength, and peace through personalized yoga.
        </p>
    </div>

    <div class="benefits">
        <div class="benefit-item">
            <div class="benefit-icon">🧘</div>
            <div class="benefit-text">
                <strong>Adaptive daily plans</strong>
                <span>Tailored to your body, goals & schedule</span>
            </div>
        </div>
        <div class="benefit-item">
            <div class="benefit-icon">📊</div>
            <div class="benefit-text">
                <strong>Progress tracking</strong>
                <span>Watch your flexibility & mindfulness grow</span>
            </div>
        </div>
        <div class="benefit-item">
            <div class="benefit-icon">🌿</div>
            <div class="benefit-text">
                <strong>200+ guided sessions</strong>
                <span>From beginner flows to advanced series</span>
            </div>
        </div>
        <div class="benefit-item">
            <div class="benefit-icon">🔒</div>
            <div class="benefit-text">
                <strong>14-day free trial</strong>
                <span>Full access, cancel anytime</span>
            </div>
        </div>
    </div>
</div>

{{-- ── RIGHT PANEL ── --}}
<div class="right-panel">
    <div class="form-card">

        <div class="form-eyebrow">Free for 14 days</div>

        <h1 class="form-title">Create your<br><em>sanctuary</em></h1>
        <p class="form-sub">Already practising with us? <a href="{{ route('login') }}">Sign in →</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name + Email row --}}
            <div class="field-row">
                <div class="field">
                    <label for="name">Full name</label>
                    <div class="input-wrap">
                        <span class="input-icon">👤</span>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Aria Sharma"
                            autocomplete="name"
                            required autofocus
                            class="{{ $errors->has('name') ? 'has-error' : '' }}"
                        />
                    </div>
                    @error('name')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <span class="input-icon">✉</span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@email.com"
                            autocomplete="username"
                            required
                            class="{{ $errors->has('email') ? 'has-error' : '' }}"
                        />
                    </div>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
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
                        placeholder="Min. 8 characters"
                        autocomplete="new-password"
                        required
                        oninput="checkStrength(this.value)"
                        class="{{ $errors->has('password') ? 'has-error' : '' }}"
                    />
                    <button type="button" class="toggle-pw" onclick="togglePw(this)" title="Toggle visibility">👁</button>
                </div>
                <div class="pw-strength">
                    <div class="strength-bar">
                        <div class="strength-seg" id="s1"></div>
                        <div class="strength-seg" id="s2"></div>
                        <div class="strength-seg" id="s3"></div>
                        <div class="strength-seg" id="s4"></div>
                    </div>
                    <div class="strength-label" id="strength-label">Enter a password</div>
                </div>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <div class="input-wrap">
                    <span class="input-icon">✅</span>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repeat your password"
                        autocomplete="new-password"
                        required
                        class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}"
                    />
                    <button type="button" class="toggle-pw" onclick="togglePw(this)" title="Toggle visibility">👁</button>
                </div>
                @error('password_confirmation')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Terms --}}
            <div class="terms-row">
                <input type="checkbox" id="terms" name="terms" required>
                <span>
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                    ZenFlow will never share your personal data.
                </span>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                Start my free trial <span class="arrow">→</span>
            </button>

            <div class="free-badge">✦ Free 14-day trial · No credit card required ✦</div>

            <div class="login-prompt">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>

        </form>
    </div>
</div>

<script>
function togglePw(btn) {
    const input = btn.previousElementSibling;
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.textContent = input.type === 'password' ? '👁' : '🙈';
}

function checkStrength(val) {
    const segs = ['s1','s2','s3','s4'].map(id => document.getElementById(id));
    const label = document.getElementById('strength-label');
    const colors = ['#C0392B', '#E67E22', '#F1C40F', '#2E7D52'];
    const labels = ['Too weak', 'Fair', 'Good', 'Strong'];

    let score = 0;
    if (val.length >= 8)           score++;
    if (/[A-Z]/.test(val))        score++;
    if (/[0-9]/.test(val))        score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    segs.forEach((s, i) => {
        s.style.background = i < score ? colors[score - 1] : 'var(--line)';
    });

    if (val.length === 0) {
        label.textContent = 'Enter a password';
        label.style.color = 'var(--muted)';
    } else {
        label.textContent = labels[score - 1] || 'Too weak';
        label.style.color = colors[score - 1] || colors[0];
    }
}
</script>
</body>
</html>