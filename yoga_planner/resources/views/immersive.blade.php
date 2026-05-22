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
    @endphp

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --imm-sage: #c4d9c6;
        --imm-sage-dark: #3e5e42;
        --imm-clay: #c87941;
        --imm-clay-light: #f0d5bc;
        --imm-dark: #0f110f;
        --imm-card: rgba(22, 26, 22, 0.7);
        --imm-border: rgba(255, 255, 255, 0.08);
        --imm-gold: #e2b474;
    }

    body {
        background-color: var(--imm-dark) !important;
    }

    .imm-page {
        min-height: calc(100vh - 4.2rem);
        background: radial-gradient(circle at 50% 15%, #18241b 0%, var(--imm-dark) 75%);
        font-family: 'DM Sans', sans-serif;
        color: #e5e7eb;
        position: relative;
        padding: 3rem 1.5rem 6rem;
    }

    /* Ambient animated lighting */
    .imm-glow {
        position: absolute;
        top: 10%;
        left: 25%;
        width: 38rem;
        height: 38rem;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(196, 217, 198, 0.08) 0%, transparent 70%);
        filter: blur(50px);
        pointer-events: none;
        z-index: 0;
        animation: immGlowPulse 15s infinite alternate ease-in-out;
    }

    @keyframes immGlowPulse {
        0% { transform: scale(1) translate(-2rem, -2rem); opacity: 0.8; }
        100% { transform: scale(1.15) translate(2rem, 2rem); opacity: 0.45; }
    }

    .imm-container {
        position: relative;
        z-index: 1;
        max-width: 1100px;
        margin: 0 auto;
        animation: immFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes immFadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Serene Header styling */
    .imm-header {
        text-align: center;
        margin-bottom: 4rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .imm-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 9999px;
        padding: 0.45rem 1rem;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: var(--imm-sage);
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }

    .imm-kicker::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--imm-gold);
        box-shadow: 0 0 10px var(--imm-gold);
    }

    .imm-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -0.03em;
    }

    .imm-title em {
        font-style: italic;
        color: var(--imm-sage);
        font-weight: 500;
    }

    .imm-subtitle {
        margin-top: 1.25rem;
        font-size: 1.05rem;
        color: #9ca3af;
        line-height: 1.75;
        font-weight: 300;
    }

    /* Pref Summary Tag line */
    .imm-pref-line {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 1.75rem;
        font-size: 0.88rem;
    }

    .imm-pref-tag {
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .imm-pref-tag strong {
        color: #fff;
        font-weight: 500;
    }

    /* Visual Grid panels */
    .imm-sections-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 2rem;
    }

    .imm-section-column {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .imm-column-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .imm-column-title span.badge {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 0.25rem 0.65rem;
        border-radius: 9999px;
        vertical-align: middle;
    }

    .imm-column-title span.badge-yoga {
        background: rgba(196, 217, 198, 0.1);
        border: 1px solid rgba(196, 217, 198, 0.2);
        color: var(--imm-sage);
    }

    .imm-column-title span.badge-med {
        background: rgba(240, 213, 188, 0.1);
        border: 1px solid rgba(240, 213, 188, 0.2);
        color: var(--imm-clay-light);
    }

    /* Cards */
    .imm-card {
        background: var(--imm-card);
        border: 1px solid var(--imm-border);
        border-radius: 28px;
        overflow: hidden;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .imm-card:hover {
        transform: translateY(-6px);
        border-color: rgba(196, 217, 198, 0.25);
    }

    .imm-card-media {
        position: relative;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-bottom: 1px solid var(--imm-border);
    }

    .imm-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .imm-card:hover .imm-card-media img {
        transform: scale(1.05);
    }

    .imm-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 17, 15, 0.8) 0%, rgba(15, 17, 15, 0) 60%);
    }

    .imm-card-duration {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(15, 17, 15, 0.7);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 600;
        color: #fff;
    }

    .imm-card-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .imm-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
    }

    .imm-card-desc {
        font-size: 0.88rem;
        color: #9ca3af;
        line-height: 1.6;
        margin-top: 0.5rem;
        font-weight: 300;
        flex: 1;
    }

    .imm-card-footer {
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .imm-card-meta {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .imm-launch-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: linear-gradient(135deg, var(--imm-sage-dark), #527556);
        color: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0.65rem 1.25rem;
        border-radius: 9999px;
        box-shadow: 0 8px 20px rgba(62, 94, 66, 0.2);
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        cursor: pointer;
    }

    .imm-launch-btn-med {
        background: linear-gradient(135deg, var(--imm-clay), #df8c54);
        box-shadow: 0 8px 20px rgba(200, 121, 65, 0.2);
    }

    .imm-card:hover .imm-launch-btn {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(62, 94, 66, 0.3);
    }

    .imm-card:hover .imm-launch-btn-med {
        box-shadow: 0 10px 25px rgba(200, 121, 65, 0.3);
    }

    .imm-empty {
        background: var(--imm-card);
        border: 1px dashed rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        padding: 2.5rem;
        text-align: center;
        color: #9ca3af;
        font-weight: 300;
    }

    /* Modal Styling */
    .imm-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(10, 12, 10, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        z-index: 100;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .imm-modal {
        background: rgba(24, 28, 24, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 36px;
        padding: 2.5rem 2rem;
        max-width: 500px;
        width: 100%;
        text-align: center;
        box-shadow: 0 35px 80px rgba(0, 0, 0, 0.6);
        animation: modalSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes modalSlideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .imm-modal-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .imm-modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.75rem;
    }

    .imm-modal-desc {
        font-size: 0.92rem;
        color: #9ca3af;
        line-height: 1.65;
        font-weight: 300;
        margin-bottom: 2rem;
    }

    .imm-modal-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .imm-modal-primary {
        background: linear-gradient(135deg, var(--imm-gold), #cd9a51);
        color: var(--imm-dark);
        border: none;
        border-radius: 9999px;
        padding: 1rem 2rem;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 10px 25px rgba(226, 180, 116, 0.25);
    }

    .imm-modal-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(226, 180, 116, 0.35);
        filter: brightness(1.05);
    }

    .imm-modal-secondary {
        background: transparent;
        color: #9ca3af;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 9999px;
        padding: 0.85rem 2rem;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .imm-modal-secondary:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    @media (max-width: 820px) {
        .imm-sections-grid {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
        .imm-page {
            padding: 2rem 1rem 4rem;
        }
        .imm-header {
            margin-bottom: 2.5rem;
        }
    }
    </style>

    <div class="imm-page">
        <div class="imm-glow"></div>

        <div class="imm-container">
            <header class="imm-header">
                <span class="imm-kicker">Immersive studio room</span>
                <h1 class="imm-title">Distraction-Free <em>Practice Room</em></h1>
                <p class="imm-subtitle">
                    Select a wellness flow below. We will enter full-screen mode automatically to mute outer disturbances, loading organic breathing rings, nature soundscapes, and calming animation loops.
                </p>

                <div class="imm-pref-line">
                    <span class="imm-pref-tag">🧘 Focus Goal: <strong>{{ $goalLabel }}</strong></span>
                    <span class="imm-pref-tag">⚡ Current Level: <strong>{{ $levelLabel }}</strong></span>
                    <span class="imm-pref-tag">⏱️ Target: <strong>{{ $preference->available_time }} min/day</strong></span>
                </div>
            </header>

            <main class="imm-sections-grid">
                <!-- Left Column: Yoga Movement Sessions -->
                <section class="imm-section-column">
                    <h2 class="imm-column-title">
                        <span>Yoga Flows</span>
                        <span class="badge badge-yoga">movement</span>
                    </h2>

                    @forelse($yoga as $session)
                        @php
                            $isJson = str_starts_with(trim($session->description), '{');
                            $descText = $isJson ? (json_decode($session->description, true)['intro'] ?? '') : $session->description;
                            $stepsArr = $isJson ? (json_decode($session->description, true)['steps'] ?? []) : [];
                            $coverImg = !empty($stepsArr) ? $stepsArr[0]['image'] : 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80&auto=format&fit=crop';
                        @endphp
                        <article class="imm-card">
                            <div class="imm-card-media">
                                <img src="{{ $coverImg }}" alt="{{ $session->name }}">
                                <div class="imm-card-overlay"></div>
                                <span class="imm-card-duration">{{ $session->duration }} Min</span>
                            </div>

                            <div class="imm-card-body">
                                <div>
                                    <h3 class="imm-card-title">{{ $session->name }}</h3>
                                    <p class="imm-card-desc">{{ $descText ?: 'Begin a mindful sequence centered around your active goals.' }}</p>
                                </div>

                                <div class="imm-card-footer">
                                    <span class="imm-card-meta">{{ $goalLabel }}</span>
                                    <button class="imm-launch-btn" onclick="openImmersiveNotice('yoga', '{{ $session->id }}', '{{ addslashes($session->name) }}')">
                                        🧘 Enter Practice Mode →
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="imm-empty">
                            <p>No goal-specific yoga sessions available. Try refining your preferences to open more flows.</p>
                        </div>
                    @endforelse
                </section>

                <!-- Right Column: Meditation Stillness Sessions -->
                <section class="imm-section-column">
                    <h2 class="imm-column-title">
                        <span>Guided Meditations</span>
                        <span class="badge badge-med">stillness</span>
                    </h2>

                    @forelse($meditation as $session)
                        @php
                            $isJson = str_starts_with(trim($session->description), '{');
                            $descText = $isJson ? (json_decode($session->description, true)['intro'] ?? '') : $session->description;
                            $stepsArr = $isJson ? (json_decode($session->description, true)['steps'] ?? []) : [];
                            $coverImg = !empty($stepsArr) ? $stepsArr[0]['image'] : 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop';
                        @endphp
                        <article class="imm-card">
                            <div class="imm-card-media">
                                <img src="{{ $coverImg }}" alt="{{ $session->name }}">
                                <div class="imm-card-overlay"></div>
                                <span class="imm-card-duration">{{ $session->duration }} Min</span>
                            </div>

                            <div class="imm-card-body">
                                <div>
                                    <h3 class="imm-card-title">{{ $session->name }}</h3>
                                    <p class="imm-card-desc">{{ $descText ?: 'Settle your thoughts with deep restorative stillness and focus.' }}</p>
                                </div>

                                <div class="imm-card-footer">
                                    <span class="imm-card-meta">Mindfulness</span>
                                    <button class="imm-launch-btn imm-launch-btn-med" onclick="openImmersiveNotice('meditation', '{{ $session->id }}', '{{ addslashes($session->name) }}')">
                                        💆 Enter Practice Mode →
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="imm-empty">
                            <p>No guided meditations available matching your current mental anchor. Update preferences to seed new sessions.</p>
                        </div>
                    @endforelse
                </section>
            </main>
        </div>
    </div>

    <!-- Immersive Setup & Fullscreen Prompt Modal Overlay -->
    <div class="imm-modal-backdrop" id="immersive-modal">
        <div class="imm-modal">
            <span class="imm-modal-icon">🌌</span>
            <h3 class="imm-modal-title" id="modal-session-title">Preparing Practice Room...</h3>
            <p class="imm-modal-desc">
                You are entering **Immersive Practice Mode**. To block out background noise and ensure absolute focus, we will enter full-screen distraction-free mode. Rhythmic breathing guides and ambient sounds will begin playing automatically.
            </p>
            <div class="imm-modal-actions">
                <button class="imm-modal-primary" id="modal-confirm-btn">
                    Begin Full-Screen Practice
                </button>
                <button class="imm-modal-secondary" onclick="closeImmersiveNotice()">
                    Cancel & Return
                </button>
            </div>
        </div>
    </div>

    <script>
    let activeSession = null;

    function openImmersiveNotice(type, id, name) {
        activeSession = { type, id };
        document.getElementById('modal-session-title').textContent = `Begin "${name}"`;
        document.getElementById('immersive-modal').style.display = 'flex';

        // Bind the trigger button
        document.getElementById('modal-confirm-btn').onclick = function() {
            // Forward user directly to the player page with immersive query flags.
            // Fullscreen is requested immediately on page mount inside practice.blade.php as a trusted user click callback!
            window.location.href = `/practice/${type}/${id}?immersive=1`;
        };
    }

    function closeImmersiveNotice() {
        document.getElementById('immersive-modal').style.display = 'none';
        activeSession = null;
    }
    </script>
</x-app-layout>
