<x-app-layout>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');

    :root {
        --profile-sage-light: #c4d9c6;
        --profile-sage-dark: #3e5e42;
        --profile-clay: #c87941;
        --profile-clay-light: #f0d5bc;
        --profile-cream: #fffef9;
        --profile-ink: #2a2a27;
        --profile-muted: #6b6b63;
        --profile-line: rgba(42, 42, 39, 0.12);
        --profile-glass: rgba(255, 255, 255, 0.74);
        --profile-glass-strong: rgba(255, 254, 249, 0.88);
    }

    .profile-page {
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 6rem);
        font-family: 'DM Sans', sans-serif;
        color: var(--profile-ink);
    }

    .profile-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        background:
            linear-gradient(150deg, rgba(255, 254, 249, 0.82), rgba(196, 217, 198, 0.42) 46%, rgba(240, 213, 188, 0.38)),
            url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1800&q=80&auto=format&fit=crop') center center / cover no-repeat;
    }

    .profile-bg::before,
    .profile-bg::after {
        content: '';
        position: absolute;
        border-radius: 9999px;
        filter: blur(14px);
    }

    .profile-bg::before {
        top: 8%;
        left: -7rem;
        width: 18rem;
        height: 18rem;
        background: rgba(196, 217, 198, 0.38);
    }

    .profile-bg::after {
        right: -6rem;
        bottom: 10%;
        width: 17rem;
        height: 17rem;
        background: rgba(240, 213, 188, 0.4);
    }

    .profile-wrap {
        position: relative;
        z-index: 1;
        max-width: 1180px;
        margin: 0 auto;
        padding: 3.5rem 1.25rem 5rem;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: minmax(320px, 0.92fr) minmax(0, 1.08fr);
        gap: 1.5rem;
        align-items: start;
    }

    .profile-hero,
    .profile-card,
    .profile-stat,
    .profile-note {
        background: var(--profile-glass);
        border: 1px solid rgba(255, 255, 255, 0.68);
        box-shadow: 0 20px 52px rgba(42, 42, 39, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .profile-hero,
    .profile-card {
        border-radius: 30px;
        padding: 2rem;
    }

    .profile-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        border-radius: 9999px;
        padding: 0.45rem 0.85rem;
        background: rgba(255, 255, 255, 0.56);
        color: var(--profile-sage-dark);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .profile-kicker::before {
        content: '';
        width: 0.45rem;
        height: 0.45rem;
        border-radius: 9999px;
        background: var(--profile-clay);
        box-shadow: 0 0 0 6px rgba(200, 121, 65, 0.1);
    }

    .profile-title,
    .profile-title em,
    .profile-stat-value {
        font-family: 'Playfair Display', serif;
    }

    .profile-title {
        margin-top: 1.35rem;
        font-size: clamp(2.3rem, 4vw, 4rem);
        line-height: 0.98;
        letter-spacing: -0.05em;
    }

    .profile-title em {
        color: var(--profile-sage-dark);
        font-style: italic;
    }

    .profile-copy {
        margin-top: 1rem;
        color: var(--profile-muted);
        line-height: 1.8;
        max-width: 34rem;
    }

    .profile-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1.4rem;
    }

    .profile-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.6);
        padding: 0.7rem 1rem;
        color: var(--profile-ink);
        font-size: 0.92rem;
    }

    .profile-tag strong {
        color: var(--profile-sage-dark);
    }

    .profile-sidebar {
        display: grid;
        gap: 1.25rem;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    .profile-stat,
    .profile-note {
        border-radius: 24px;
        padding: 1.15rem;
        background: var(--profile-glass-strong);
    }

    .profile-stat-label {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--profile-muted);
    }

    .profile-stat-value {
        margin-top: 0.55rem;
        font-size: 2rem;
        line-height: 1;
    }

    .profile-stat-sub,
    .profile-note p {
        margin-top: 0.45rem;
        color: var(--profile-muted);
        line-height: 1.72;
        font-size: 0.92rem;
    }

    .profile-note-dark {
        background: rgba(42, 42, 39, 0.9);
        border-color: rgba(255, 255, 255, 0.08);
        color: rgba(255, 254, 249, 0.92);
    }

    .profile-note-dark .profile-stat-label,
    .profile-note-dark p {
        color: rgba(255, 254, 249, 0.72);
    }

    .profile-stack {
        display: grid;
        gap: 1.25rem;
    }

    .profile-card {
        background: var(--profile-glass-strong);
    }

    .profile-card-danger {
        border-color: rgba(200, 121, 65, 0.16);
        box-shadow: 0 20px 52px rgba(200, 121, 65, 0.08);
    }

    .profile-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.95rem;
        line-height: 1.05;
        letter-spacing: -0.04em;
    }

    .profile-section-copy {
        margin-top: 0.55rem;
        color: var(--profile-muted);
        line-height: 1.75;
        max-width: 34rem;
    }

    .profile-input {
        width: 100%;
        border-radius: 18px;
        border: 1px solid rgba(42, 42, 39, 0.1);
        background: rgba(255, 255, 255, 0.82);
        padding: 0.95rem 1rem;
        color: var(--profile-ink);
        outline: none;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
        transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }

    .profile-input:focus {
        border-color: rgba(62, 94, 66, 0.32);
        box-shadow: 0 0 0 4px rgba(196, 217, 198, 0.35);
        transform: translateY(-1px);
    }

    .profile-label {
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--profile-ink);
    }

    .profile-button-primary,
    .profile-button-secondary,
    .profile-button-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        border-radius: 9999px;
        padding: 0.9rem 1.35rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        text-transform: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .profile-button-primary {
        background: linear-gradient(135deg, var(--profile-sage-dark), #547659);
        color: var(--profile-cream);
        box-shadow: 0 18px 28px rgba(62, 94, 66, 0.22);
    }

    .profile-button-secondary {
        background: rgba(255, 255, 255, 0.72);
        color: var(--profile-ink);
        border: 1px solid rgba(42, 42, 39, 0.08);
    }

    .profile-button-danger {
        background: linear-gradient(135deg, #b85b33, #9e4124);
        color: var(--profile-cream);
        box-shadow: 0 18px 28px rgba(158, 65, 36, 0.2);
    }

    .profile-button-primary:hover,
    .profile-button-secondary:hover,
    .profile-button-danger:hover {
        transform: translateY(-2px);
    }

    .profile-button-primary:hover {
        box-shadow: 0 22px 36px rgba(62, 94, 66, 0.26);
        filter: brightness(1.03);
    }

    .profile-button-danger:hover {
        box-shadow: 0 22px 36px rgba(158, 65, 36, 0.24);
        filter: brightness(1.03);
    }

    .profile-success {
        color: var(--profile-sage-dark);
        font-weight: 500;
    }

    .profile-helper-link {
        color: var(--profile-clay);
        text-decoration: underline;
        text-underline-offset: 0.2rem;
    }

    .profile-modal-panel {
        border-radius: 28px;
        background: rgba(255, 254, 249, 0.96);
        border: 1px solid rgba(255, 255, 255, 0.72);
        box-shadow: 0 24px 60px rgba(42, 42, 39, 0.18);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    @media (max-width: 1024px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .profile-wrap {
            padding: 2rem 0.9rem 4rem;
        }

        .profile-hero,
        .profile-card {
            padding: 1.35rem;
            border-radius: 24px;
        }

        .profile-stats {
            grid-template-columns: 1fr;
        }
    }
    </style>

    <div class="profile-page">
        <div class="profile-bg"></div>

        <div class="profile-wrap">
            <div class="profile-grid">
                <aside class="profile-sidebar">
                    <section class="profile-hero">
                        <span class="profile-kicker">Account center</span>
                        <h1 class="profile-title">Keep your profile <em>clear</em>, current, and secure.</h1>
                        <p class="profile-copy">
                            Manage your personal details, refresh your password, and keep the account settings behind your yoga journey feeling as polished as the rest of the app.
                        </p>

                        <div class="profile-tags">
                            <span class="profile-tag"><strong>Name:</strong> {{ $user->name }}</span>
                            <span class="profile-tag"><strong>Email:</strong> {{ $user->email }}</span>
                        </div>
                    </section>

                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="profile-stat-label">Profile status</div>
                            <div class="profile-stat-value">Active</div>
                            <div class="profile-stat-sub">Your account details can be updated anytime.</div>
                        </div>

                        <div class="profile-stat">
                            <div class="profile-stat-label">Email state</div>
                            <div class="profile-stat-value">
                                {{ $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail() ? 'Pending' : 'Verified' }}
                            </div>
                            <div class="profile-stat-sub">Verification helps protect account recovery and sign-in trust.</div>
                        </div>
                    </div>

                    <div class="profile-note profile-note-dark">
                        <div class="profile-stat-label">Security note</div>
                        <p>
                            Use a strong password you do not reuse elsewhere, and only change your email when you can access the new inbox for verification.
                        </p>
                    </div>
                </aside>

                <div class="profile-stack">
                    <section class="profile-card">
                        @include('profile.partials.update-profile-information-form')
                    </section>

                    <section class="profile-card">
                        @include('profile.partials.update-password-form')
                    </section>

                    <section class="profile-card profile-card-danger">
                        @include('profile.partials.delete-user-form')
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
