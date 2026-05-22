<x-app-layout>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --room-sage: #c4d9c6;
        --room-sage-dark: #3e5e42;
        --room-clay: #c87941;
        --room-cream: #fffef9;
        --room-dark: #121412;
        --room-card: rgba(30, 35, 30, 0.65);
        --room-glass: rgba(255, 255, 255, 0.08);
        --room-border: rgba(255, 255, 255, 0.12);
        --room-gold: #e2b474;
    }

    body {
        background-color: var(--room-dark) !important;
    }

    .room-page {
        min-height: calc(100vh - 4.2rem);
        background: radial-gradient(circle at 50% 30%, #1e2820 0%, var(--room-dark) 85%);
        font-family: 'DM Sans', sans-serif;
        color: #e5e7eb;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    /* Ambient animated lighting */
    .room-glow {
        position: absolute;
        width: 32rem;
        height: 32rem;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(196, 217, 198, 0.06) 0%, transparent 70%);
        filter: blur(40px);
        pointer-events: none;
        z-index: 0;
        animation: glowPulse 12s infinite alternate ease-in-out;
    }

    @keyframes glowPulse {
        0% { transform: scale(1) translate(-2rem, -2rem); opacity: 0.8; }
        100% { transform: scale(1.2) translate(2rem, 2rem); opacity: 0.5; }
    }

    .room-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1000px;
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
        gap: 2rem;
        animation: roomFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes roomFadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Immersive Visual Player Box */
    .room-player-box {
        background: var(--room-card);
        border: 1px solid var(--room-border);
        border-radius: 32px;
        padding: 2rem;
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 520px;
        box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding-bottom: 1rem;
    }

    .room-meta {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--room-sage);
    }

    .room-session-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #fff;
        margin-top: 0.25rem;
    }

    .room-exit {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 9999px;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: #9ca3af;
        transition: all 0.2s;
    }

    .room-exit:hover {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.25);
        color: #fca5a5;
        transform: translateY(-1px);
    }

    /* Core breathing indicator */
    .breathing-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 2.5rem 0;
        position: relative;
    }

    .breath-ring {
        position: relative;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .breath-circle-inner {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(196, 217, 198, 0.15) 0%, rgba(62, 94, 66, 0.35) 100%);
        border: 1px solid rgba(196, 217, 198, 0.3);
        box-shadow: 0 0 30px rgba(62, 94, 66, 0.2);
        animation: breathAnimation 12s infinite ease-in-out;
        z-index: -1;
    }

    /* Breathing Text */
    .breath-text {
        font-size: 1.15rem;
        font-weight: 500;
        color: #fff;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        animation: breathTextAnimation 12s infinite ease-in-out;
    }

    @keyframes breathAnimation {
        0%, 100% { transform: scale(0.78); opacity: 0.45; }
        33% { transform: scale(1.18); opacity: 0.95; box-shadow: 0 0 45px rgba(196, 217, 198, 0.45); }
        66% { transform: scale(1.18); opacity: 0.95; }
    }

    @keyframes breathTextAnimation {
        0%, 100% { content: "Breathe In"; opacity: 0.6; }
        33% { content: "Breathe In"; opacity: 1; }
        34%, 66% { content: "Hold"; }
        67%, 99% { content: "Breathe Out"; }
    }

    /* Step guide illustration & details */
    .room-guide-box {
        background: var(--room-card);
        border: 1px solid var(--room-border);
        border-radius: 32px;
        overflow: hidden;
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        display: flex;
        flex-direction: column;
        box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
    }

    .room-image-container {
        position: relative;
        aspect-ratio: 16 / 11;
        overflow: hidden;
        border-bottom: 1px solid var(--room-border);
    }

    .room-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .room-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(18, 20, 18, 0.9) 0%, rgba(18, 20, 18, 0) 65%);
    }

    /* CSS animations mapping for interactive focus */
    .pulse-slow { animation: breathPulse 8s infinite alternate ease-in-out; }
    .wave-slow { animation: gentleSway 10s infinite alternate ease-in-out; }
    .glowing-effect { animation: softGlow 6s infinite alternate ease-in-out; }
    .breath-circle { animation: deepPulse 14s infinite alternate ease-in-out; }

    @keyframes breathPulse {
        0% { filter: saturate(0.85) brightness(0.9); }
        100% { filter: saturate(1.1) brightness(1.1); transform: scale(1.03); }
    }
    @keyframes gentleSway {
        0% { transform: scale(1.02) rotate(-1deg); }
        100% { transform: scale(1.05) rotate(1deg); }
    }
    @keyframes softGlow {
        0% { box-shadow: inset 0 0 20px rgba(255,255,255,0.05); }
        100% { box-shadow: inset 0 0 40px rgba(196, 217, 198, 0.25); transform: scale(1.04); }
    }
    @keyframes deepPulse {
        0% { transform: scale(1); filter: contrast(0.9); }
        100% { transform: scale(1.06); filter: contrast(1.1); }
    }

    .room-guide-body {
        padding: 1.5rem 1.75rem 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .room-step-indicator {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 9999px;
        padding: 0.4rem 0.85rem;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--room-sage);
        margin-bottom: 0.75rem;
    }

    .room-guide-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.15;
    }

    .room-guide-instructions {
        margin-top: 0.75rem;
        font-size: 0.94rem;
        color: #9ca3af;
        line-height: 1.7;
        font-weight: 300;
    }

    /* Sound mixer panel */
    .sound-mixer-panel {
        margin-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding-top: 1.25rem;
    }

    .mixer-label {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .mixer-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.65rem;
    }

    .mixer-btn {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 0.7rem 0.5rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: #9ca3af;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.35rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .mixer-btn:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
    }

    .mixer-btn.active {
        background: rgba(196, 217, 198, 0.12);
        border-color: rgba(196, 217, 198, 0.3);
        color: var(--room-sage);
        box-shadow: 0 0 15px rgba(62, 94, 66, 0.25);
    }

    .mixer-btn-icon {
        font-size: 1.2rem;
    }

    /* Bottom Player controls */
    .player-controls {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.25rem;
    }

    .timer-display {
        font-family: 'Playfair Display', serif;
        font-size: 3.4rem;
        font-weight: 700;
        color: #fff;
        line-height: 1;
        letter-spacing: 0.02em;
        text-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .control-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .btn-secondary-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary-circle:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: scale(1.05);
    }

    .btn-play-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--room-sage), #8cb190);
        color: var(--room-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 25px rgba(62, 94, 66, 0.35);
    }

    .btn-play-circle:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(62, 94, 66, 0.45);
    }

    /* Celebration Screen */
    .room-celebration {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 45%, #242c25 0%, var(--room-dark) 90%);
        z-index: 10;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
        animation: roomFadeIn 0.8s ease;
    }

    .gold-ripple {
        position: relative;
        width: 150px;
        height: 150px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ripple-ring {
        position: absolute;
        border: 2px solid var(--room-gold);
        border-radius: 50%;
        width: 100%;
        height: 100%;
        opacity: 0;
        animation: rippleEffect 3s infinite cubic-bezier(0.1, 0.8, 0.3, 1);
    }

    .ripple-ring:nth-child(2) { animation-delay: 1s; }
    .ripple-ring:nth-child(3) { animation-delay: 2s; }

    .ripple-center {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--room-gold), #b8860b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--room-dark);
        font-size: 2.2rem;
        box-shadow: 0 0 35px rgba(226, 180, 116, 0.45);
        z-index: 1;
    }

    @keyframes rippleEffect {
        0% { transform: scale(0.6); opacity: 0.8; }
        100% { transform: scale(2.2); opacity: 0; }
    }

    .celebration-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3rem);
        color: var(--room-gold);
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }

    .celebration-sub {
        font-size: 1.1rem;
        color: #9ca3af;
        max-width: 32rem;
        line-height: 1.7;
        margin-bottom: 2.5rem;
        font-weight: 300;
    }

    .btn-finish {
        background: linear-gradient(135deg, var(--room-gold), #cd9a51);
        color: var(--room-dark);
        border: none;
        border-radius: 9999px;
        padding: 1.1rem 2.8rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s;
        box-shadow: 0 15px 35px rgba(226, 180, 116, 0.3);
    }

    .btn-finish:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 40px rgba(226, 180, 116, 0.4);
        filter: brightness(1.05);
    }

    @media (max-width: 820px) {
        .room-container {
            grid-template-columns: 1fr;
        }
        .room-player-box {
            min-height: 480px;
        }
    }
    </style>

    <div class="room-page">
        <div class="room-glow"></div>

        <div class="room-container" id="player-container">
            <!-- Left side: Session Player controls and breathing ring -->
            <section class="room-player-box">
                <div class="room-header">
                    <div>
                        <span class="room-meta">{{ ucfirst($type) }} Practice</span>
                        <h2 class="room-session-title">{{ $session->name }}</h2>
                    </div>

                    <a href="/plan" class="room-exit" onclick="stopAmbientSound()">
                        <span>← Exit</span>
                    </a>
                </div>

                <div class="breathing-wrapper">
                    <div class="breath-ring">
                        <div class="breath-circle-inner" id="breathing-circle"></div>
                        <span class="breath-text" id="breathing-text">Center</span>
                    </div>
                </div>

                <div class="player-controls">
                    <div class="timer-display" id="timer-display">00:00</div>

                    <div class="control-actions">
                        <button class="btn-secondary-circle" id="btn-prev" onclick="changeStep(-1)" title="Previous Pose">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>

                        <button class="btn-play-circle" id="btn-play" onclick="togglePlay()" title="Play/Pause">
                            <svg class="w-6 h-6 ml-1" id="play-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                        </button>

                        <button class="btn-secondary-circle" id="btn-next" onclick="changeStep(1)" title="Next Pose">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </section>

            <!-- Right side: Image sequence, instructions, and sound mixer -->
            <section class="room-guide-box">
                <div class="room-image-container">
                    <img id="step-image" src="" alt="Pose guide" class="pulse-slow">
                    <div class="room-image-overlay"></div>
                </div>

                <div class="room-guide-body">
                    <div>
                        <span class="room-step-indicator" id="step-indicator">Step 1 of 1</span>
                        <h3 class="room-guide-title" id="step-title">Get Ready</h3>
                        <p class="room-guide-instructions" id="step-instruction">Sit comfortably and relax.</p>
                    </div>

                    <!-- Sound Mixer Panel -->
                    <div class="sound-mixer-panel">
                        <div class="mixer-label">ambient soundscapes</div>
                        <div class="mixer-buttons">
                            <button class="mixer-btn active" id="ambient-none" onclick="setAmbientSound('none')">
                                <span class="mixer-btn-icon">🔇</span>
                                <span>Silence</span>
                            </button>
                            <button class="mixer-btn" id="ambient-rain" onclick="setAmbientSound('rain')">
                                <span class="mixer-btn-icon">🌧️</span>
                                <span>Forest Rain</span>
                            </button>
                            <button class="mixer-btn" id="ambient-ocean" onclick="setAmbientSound('ocean')">
                                <span class="mixer-btn-icon">🌊</span>
                                <span>Ocean Waves</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Hidden Audio Element for ambient sound loops -->
        <audio id="ambient-player" loop preload="auto"></audio>
        
        <!-- Gentle Chime for step completions -->
        <audio id="chime-player" preload="auto">
            <source src="https://actions.google.com/sounds/v1/alarms/dinner_chime.ogg" type="audio/ogg">
        </audio>

        <!-- Hidden Form to submit completed workout -->
        <form id="complete-form" method="POST" action="{{ route('complete') }}" style="display:none;">
            @csrf
        </form>

        <!-- Serene Completion Room -->
        <div class="room-celebration" id="celebration-container">
            <div class="gold-ripple">
                <div class="ripple-ring"></div>
                <div class="ripple-ring"></div>
                <div class="ripple-ring"></div>
                <div class="ripple-center">🕉️</div>
            </div>

            <h1 class="celebration-title">Namaste, {{ Auth::user()->name }}</h1>
            <p class="celebration-sub">
                You have completed your daily practice of <strong>{{ $session->name }}</strong>. May you carry this sense of peacefulness, focus, and clarity into the rest of your day.
            </p>

            <button class="btn-finish" onclick="submitPractice()">
                Complete & Log Practice
            </button>
        </div>
    </div>

    <!-- Interactive Player Logic -->
    <script>
    // Load session step sequence from controller
    const sessionData = @json($data);
    const steps = sessionData.steps || [];
    
    let currentStepIndex = 0;
    let timerInterval = null;
    let isPlaying = false;
    let currentSecondsRemaining = 0;

    // Google actions audio links for rock-solid ambient soundscapes
    const soundscapes = {
        none: "",
        rain: "https://actions.google.com/sounds/v1/weather/rain_heavy_loud.ogg",
        ocean: "https://actions.google.com/sounds/v1/water/sea_waves.ogg"
    };

    const ambientPlayer = document.getElementById('ambient-player');
    const chimePlayer = document.getElementById('chime-player');

    // Initialize the player
    function initPlayer() {
        if (steps.length > 0) {
            renderStep(0);
        }
    }

    // Render current step details
    function renderStep(index) {
        currentStepIndex = index;
        const step = steps[index];

        // Update timer
        currentSecondsRemaining = step.duration;
        updateTimerDisplay();

        // Update step guidelines
        document.getElementById('step-indicator').textContent = `Step ${index + 1} of ${steps.length}`;
        document.getElementById('step-title').textContent = step.name;
        document.getElementById('step-instruction').textContent = step.instruction;
        
        // Update image
        const imgEl = document.getElementById('step-image');
        imgEl.src = step.image;
        
        // Reset and map custom CSS animations classes
        imgEl.className = '';
        imgEl.classList.add(step.animation_class || 'pulse-slow');

        // Manage button active states
        document.getElementById('btn-prev').disabled = index === 0;
        document.getElementById('btn-prev').style.opacity = index === 0 ? '0.4' : '1';

        // Pulse breathing circle animation matching step play/pause state
        updatePulseState();
    }

    function updateTimerDisplay() {
        const mins = Math.floor(currentSecondsRemaining / 60);
        const secs = currentSecondsRemaining % 60;
        document.getElementById('timer-display').textContent = 
            `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    function togglePlay() {
        if (isPlaying) {
            pause();
        } else {
            play();
        }
    }

    function play() {
        isPlaying = true;
        document.getElementById('btn-play').title = "Pause";
        document.getElementById('play-icon').innerHTML = '<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path>';
        
        // Pulse animation state
        updatePulseState();

        timerInterval = setInterval(() => {
            if (currentSecondsRemaining > 0) {
                currentSecondsRemaining--;
                updateTimerDisplay();
            } else {
                // Play gentle chime at step end
                try { chimePlayer.play(); } catch(e) {}
                
                // Move to next step or finish
                if (currentStepIndex < steps.length - 1) {
                    changeStep(1);
                } else {
                    finishPractice();
                }
            }
        }, 1000);
    }

    function pause() {
        isPlaying = false;
        document.getElementById('btn-play').title = "Play";
        document.getElementById('play-icon').innerHTML = '<path d="M8 5v14l11-7z"></path>';
        
        updatePulseState();
        clearInterval(timerInterval);
    }

    function updatePulseState() {
        const circle = document.getElementById('breathing-circle');
        const text = document.getElementById('breathing-text');
        
        if (isPlaying) {
            circle.style.animationPlayState = 'running';
            text.style.animationPlayState = 'running';
            text.textContent = 'Flowing';
        } else {
            circle.style.animationPlayState = 'paused';
            text.style.animationPlayState = 'paused';
            text.textContent = 'Paused';
        }
    }

    function changeStep(direction) {
        const newIndex = currentStepIndex + direction;
        if (newIndex >= 0 && newIndex < steps.length) {
            const wasPlaying = isPlaying;
            pause();
            renderStep(newIndex);
            if (wasPlaying) {
                play();
            }
        }
    }

    // Set ambient sound loops
    function setAmbientSound(soundKey) {
        // Toggle active button styling
        ['none', 'rain', 'ocean'].forEach(key => {
            document.getElementById(`ambient-${key}`).classList.remove('active');
        });
        document.getElementById(`ambient-${soundKey}`).classList.add('active');

        // Play or stop audio loops
        if (soundKey === 'none') {
            ambientPlayer.pause();
        } else {
            ambientPlayer.src = soundscapes[soundKey];
            ambientPlayer.load();
            
            // Try to play (browsers require user interaction first)
            const playPromise = ambientPlayer.play();
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    console.log("Ambient autoplay prevented. Will play on interaction.");
                });
            }
        }
    }

    function stopAmbientSound() {
        ambientPlayer.pause();
    }

    // Show peaceful final celebration
    function finishPractice() {
        pause();
        stopAmbientSound();

        // Play gentle finishing sound chime
        try { chimePlayer.play(); } catch(e) {}

        // Swap view layers
        document.getElementById('player-container').style.display = 'none';
        document.getElementById('celebration-container').style.display = 'flex';
    }

    // Submit back to standard complete forms
    function submitPractice() {
        document.getElementById('complete-form').submit();
    }

    // Load initial player on page mount
    window.addEventListener('DOMContentLoaded', initPlayer);
    </script>
</x-app-layout>
