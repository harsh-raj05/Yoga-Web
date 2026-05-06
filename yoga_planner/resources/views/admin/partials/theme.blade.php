<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');

:root {
    --admin-sage-light: #c4d9c6;
    --admin-sage-dark: #3e5e42;
    --admin-clay: #c87941;
    --admin-clay-light: #f0d5bc;
    --admin-cream: #fffef9;
    --admin-ink: #2a2a27;
    --admin-muted: #6b6b63;
    --admin-line: rgba(42, 42, 39, 0.12);
    --admin-glass: rgba(255, 255, 255, 0.74);
    --admin-glass-strong: rgba(255, 254, 249, 0.88);
}

.admin-page {
    position: relative;
    overflow: hidden;
    min-height: calc(100vh - 6rem);
    font-family: 'DM Sans', sans-serif;
    color: var(--admin-ink);
}

.admin-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    background:
        linear-gradient(150deg, rgba(255, 254, 249, 0.82), rgba(196, 217, 198, 0.44) 46%, rgba(240, 213, 188, 0.42)),
        var(--admin-bg-image, url('https://images.unsplash.com/photo-1518611012118-696072aa579a?w=1800&q=80&auto=format&fit=crop')) center center / cover no-repeat;
}

.admin-bg::before,
.admin-bg::after {
    content: '';
    position: absolute;
    border-radius: 9999px;
    filter: blur(14px);
}

.admin-bg::before {
    top: 8%;
    left: -7rem;
    width: 18rem;
    height: 18rem;
    background: rgba(196, 217, 198, 0.38);
}

.admin-bg::after {
    right: -6rem;
    bottom: 8%;
    width: 17rem;
    height: 17rem;
    background: rgba(240, 213, 188, 0.42);
}

.admin-wrap {
    position: relative;
    z-index: 1;
    max-width: 1120px;
    margin: 0 auto;
    padding: 3.5rem 1.25rem 5rem;
}

.admin-shell,
.admin-card,
.admin-stat-card,
.admin-item,
.admin-success,
.admin-empty,
.admin-tip {
    background: var(--admin-glass);
    border: 1px solid rgba(255, 255, 255, 0.68);
    box-shadow: 0 20px 52px rgba(42, 42, 39, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.admin-shell,
.admin-card {
    border-radius: 30px;
    padding: 2rem;
}

.admin-kicker {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    border-radius: 9999px;
    padding: 0.45rem 0.85rem;
    background: rgba(255, 255, 255, 0.56);
    color: var(--admin-sage-dark);
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.16em;
    text-transform: uppercase;
}

.admin-kicker::before {
    content: '';
    width: 0.45rem;
    height: 0.45rem;
    border-radius: 9999px;
    background: var(--admin-clay);
    box-shadow: 0 0 0 6px rgba(200, 121, 65, 0.1);
}

.admin-title,
.admin-card-title,
.admin-stat-value,
.admin-item-title {
    font-family: 'Playfair Display', serif;
}

.admin-title {
    margin-top: 1.25rem;
    font-size: clamp(2.2rem, 4vw, 4rem);
    line-height: 0.98;
    letter-spacing: -0.05em;
}

.admin-title em {
    color: var(--admin-sage-dark);
    font-style: italic;
}

.admin-copy {
    margin-top: 0.95rem;
    max-width: 38rem;
    color: var(--admin-muted);
    line-height: 1.8;
}

.admin-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 1rem;
    margin-top: 1.5rem;
}

.admin-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
}

.admin-button-primary,
.admin-button-secondary,
.admin-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.65rem;
    border-radius: 9999px;
    padding: 0.9rem 1.4rem;
    font-weight: 600;
    transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
}

.admin-button-primary {
    background: linear-gradient(135deg, var(--admin-sage-dark), #547659);
    color: var(--admin-cream);
    box-shadow: 0 18px 28px rgba(62, 94, 66, 0.22);
}

.admin-button-secondary {
    background: rgba(255, 255, 255, 0.72);
    color: var(--admin-ink);
    border: 1px solid rgba(42, 42, 39, 0.08);
}

.admin-delete {
    background: rgba(200, 121, 65, 0.12);
    color: #a04e1d;
    border: 1px solid rgba(200, 121, 65, 0.18);
    padding-inline: 1rem;
}

.admin-button-primary:hover,
.admin-button-secondary:hover,
.admin-delete:hover {
    transform: translateY(-2px);
}

.admin-button-primary:hover {
    box-shadow: 0 22px 36px rgba(62, 94, 66, 0.26);
    filter: brightness(1.03);
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1.5rem;
}

.admin-stat-card {
    border-radius: 24px;
    padding: 1.2rem;
    background: var(--admin-glass-strong);
}

.admin-stat-label {
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--admin-muted);
}

.admin-stat-value {
    margin-top: 0.55rem;
    font-size: 2rem;
    line-height: 1;
}

.admin-stat-sub {
    margin-top: 0.45rem;
    color: var(--admin-muted);
    font-size: 0.9rem;
    line-height: 1.65;
}

.admin-success,
.admin-empty,
.admin-tip {
    margin-top: 1.2rem;
    border-radius: 24px;
    padding: 1rem 1.15rem;
}

.admin-success {
    background: rgba(196, 217, 198, 0.52);
    color: var(--admin-sage-dark);
    font-weight: 500;
}

.admin-empty {
    background: rgba(255, 255, 255, 0.56);
    color: var(--admin-muted);
    line-height: 1.75;
}

.admin-list {
    display: grid;
    gap: 1rem;
    margin-top: 1.5rem;
}

.admin-item {
    border-radius: 26px;
    padding: 1.2rem 1.25rem;
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    align-items: flex-start;
}

.admin-item-title {
    font-size: 1.45rem;
    line-height: 1.08;
    letter-spacing: -0.02em;
}

.admin-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
    margin-top: 0.65rem;
}

.admin-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    border-radius: 9999px;
    padding: 0.45rem 0.75rem;
    background: rgba(255, 255, 255, 0.62);
    color: var(--admin-ink);
    font-size: 0.82rem;
    font-weight: 500;
}

.admin-badge::before {
    content: '';
    width: 0.4rem;
    height: 0.4rem;
    border-radius: 9999px;
    background: var(--admin-clay);
}

.admin-item-copy {
    margin-top: 0.8rem;
    color: var(--admin-muted);
    line-height: 1.72;
    font-size: 0.94rem;
    max-width: 42rem;
}

.admin-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.2rem;
    margin-top: 1.35rem;
}

.admin-field-full {
    grid-column: 1 / -1;
}

.admin-label {
    display: block;
    margin-bottom: 0.55rem;
    font-size: 0.86rem;
    font-weight: 600;
    color: var(--admin-ink);
}

.admin-hint {
    display: block;
    margin-top: 0.35rem;
    font-size: 0.82rem;
    color: var(--admin-muted);
}

.admin-input,
.admin-select,
.admin-textarea {
    width: 100%;
    border-radius: 18px;
    border: 1px solid rgba(42, 42, 39, 0.1);
    background: rgba(255, 255, 255, 0.82);
    padding: 0.95rem 1rem;
    color: var(--admin-ink);
    outline: none;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}

.admin-textarea {
    min-height: 8rem;
    resize: vertical;
}

.admin-input:focus,
.admin-select:focus,
.admin-textarea:focus {
    border-color: rgba(62, 94, 66, 0.32);
    box-shadow: 0 0 0 4px rgba(196, 217, 198, 0.35);
    transform: translateY(-1px);
}

.admin-error {
    margin-top: 0.45rem;
    color: #9b3a2e;
    font-size: 0.83rem;
}

.admin-form-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}

.admin-card-title {
    font-size: 2rem;
    line-height: 1.02;
    letter-spacing: -0.04em;
}

.admin-card-copy {
    margin-top: 0.55rem;
    color: var(--admin-muted);
    line-height: 1.72;
    max-width: 34rem;
}

.admin-pill {
    flex-shrink: 0;
    border-radius: 9999px;
    padding: 0.55rem 0.85rem;
    background: rgba(240, 213, 188, 0.4);
    color: var(--admin-clay);
    font-size: 0.76rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.admin-tip {
    background: rgba(42, 42, 39, 0.9);
    border-color: rgba(255, 255, 255, 0.08);
    color: rgba(255, 254, 249, 0.84);
    line-height: 1.78;
}

.admin-form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 1.6rem;
    padding-top: 1.35rem;
    border-top: 1px solid var(--admin-line);
}

.admin-form-copy {
    max-width: 28rem;
    color: var(--admin-muted);
    line-height: 1.75;
    font-size: 0.92rem;
}

@media (max-width: 900px) {
    .admin-toolbar,
    .admin-form-head,
    .admin-form-actions,
    .admin-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .admin-stats,
    .admin-form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .admin-wrap {
        padding: 2rem 0.9rem 4rem;
    }

    .admin-shell,
    .admin-card {
        padding: 1.35rem;
        border-radius: 24px;
    }

    .admin-actions,
    .admin-button-primary,
    .admin-button-secondary,
    .admin-delete {
        width: 100%;
    }
}
</style>
