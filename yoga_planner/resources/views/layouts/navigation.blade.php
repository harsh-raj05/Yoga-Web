@php
    $user = Auth::user();

    $navLinks = [
        [
            'label' => 'Dashboard',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'label' => 'Preferences',
            'href' => url('/preferences'),
            'active' => request()->is('preferences'),
        ],
        [
            'label' => 'Plan',
            'href' => url('/plan'),
            'active' => request()->is('plan'),
        ],
    ];

    if ($user?->is_admin) {
        $navLinks[] = [
            'label' => 'Admin Yoga',
            'href' => url('/admin/yoga'),
            'active' => request()->is('admin/yoga*'),
        ];

        $navLinks[] = [
            'label' => 'Admin Meditation',
            'href' => url('/admin/meditation'),
            'active' => request()->is('admin/meditation*'),
        ];
    }

    $initials = $user
        ? collect(explode(' ', trim($user->name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->implode('')
        : 'YP';
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');

.yn-shell {
    position: sticky;
    top: 0;
    z-index: 40;
    padding: 1rem 1rem 0;
}

.yn-card {
    background:
        linear-gradient(135deg, rgba(255, 254, 249, 0.9), rgba(255, 255, 255, 0.68)),
        linear-gradient(120deg, rgba(196, 217, 198, 0.18), rgba(240, 213, 188, 0.18));
    border: 1px solid rgba(255, 255, 255, 0.7);
    box-shadow: 0 16px 40px rgba(42, 42, 39, 0.08);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
}

.yn-brand-title,
.yn-menu-title {
    font-family: 'Playfair Display', serif;
}

.yn-brand-mark {
    background: linear-gradient(135deg, rgba(196, 217, 198, 0.95), rgba(240, 213, 188, 0.95));
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
}

.yn-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    padding: 0.7rem 1rem;
    border-radius: 9999px;
    color: #4f5a51;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    line-height: 1;
    transition: all 0.2s ease;
}

.yn-link::before {
    content: '';
    width: 0.42rem;
    height: 0.42rem;
    border-radius: 9999px;
    background: rgba(62, 94, 66, 0.25);
    transition: inherit;
}

.yn-link:hover {
    color: #2a2a27;
    background: rgba(255, 255, 255, 0.62);
    transform: translateY(-1px);
}

.yn-link-active {
    color: #2a2a27;
    background: rgba(255, 255, 255, 0.82);
    box-shadow: inset 0 0 0 1px rgba(62, 94, 66, 0.12);
}

.yn-link-active::before {
    background: #c87941;
    box-shadow: 0 0 0 4px rgba(200, 121, 65, 0.12);
}

.yn-account-trigger,
.yn-mobile-toggle,
.yn-mobile-link,
.yn-profile-link {
    transition: all 0.2s ease;
}

.yn-account-trigger:hover,
.yn-mobile-toggle:hover,
.yn-mobile-link:hover,
.yn-profile-link:hover {
    transform: translateY(-1px);
}

.yn-menu-panel {
    background: rgba(255, 254, 249, 0.94);
    border: 1px solid rgba(62, 94, 66, 0.08);
    box-shadow: 0 18px 36px rgba(42, 42, 39, 0.12);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
}

.yn-mobile-link-active {
    background: rgba(196, 217, 198, 0.34);
    color: #2a2a27;
}

@media (max-width: 640px) {
    .yn-shell {
        padding: 0.75rem 0.75rem 0;
    }
}
</style>

<nav x-data="{ open: false }" class="yn-shell">
    <div class="max-w-7xl mx-auto">
        <div class="yn-card rounded-[28px] px-4 py-3 sm:px-5">
            <div class="flex items-center justify-between gap-4">
                <div class="flex min-w-0 items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-3">
                        <span class="yn-brand-mark flex h-12 w-12 items-center justify-center rounded-2xl border border-white/70">
                            <x-application-logo class="h-7 w-auto fill-current text-[#3E5E42]" />
                        </span>
                        <span class="min-w-0">
                            <span class="yn-brand-title block truncate text-lg font-semibold tracking-[-0.03em] text-[#2A2A27]">
                                Yoga Planner
                            </span>
                            <span class="block truncate text-xs font-medium uppercase tracking-[0.24em] text-[#6B6B63]">
                                Mindful routine studio
                            </span>
                        </span>
                    </a>
                </div>

                <div class="hidden items-center gap-2 lg:flex">
                    @foreach ($navLinks as $link)
                        <a
                            href="{{ $link['href'] }}"
                            class="yn-link {{ $link['active'] ? 'yn-link-active' : '' }}"
                            @if ($link['active']) aria-current="page" @endif
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="hidden items-center gap-3 sm:flex">
                    <x-dropdown align="right" width="64" contentClasses="py-2 yn-menu-panel rounded-3xl">
                        <x-slot name="trigger">
                            <button class="yn-account-trigger inline-flex items-center gap-3 rounded-full border border-white/70 bg-white/70 px-3 py-2 text-left shadow-sm focus:outline-none">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#3E5E42] text-xs font-semibold uppercase tracking-[0.24em] text-[#FFFEF9]">
                                    {{ $initials }}
                                </span>
                                <span class="hidden text-left lg:block">
                                    <span class="block text-[0.68rem] font-semibold uppercase tracking-[0.22em] text-[#6B6B63]">
                                        Account
                                    </span>
                                    <span class="block max-w-[9rem] truncate text-sm font-semibold text-[#2A2A27]">
                                        {{ $user?->name }}
                                    </span>
                                </span>
                                <svg class="h-4 w-4 text-[#6B6B63]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 pb-3 pt-2">
                                <p class="yn-menu-title text-lg font-semibold text-[#2A2A27]">{{ $user?->name }}</p>
                                <p class="mt-1 text-sm text-[#6B6B63]">{{ $user?->email }}</p>
                            </div>

                            <div class="px-2">
                                <x-dropdown-link :href="route('profile.edit')" class="yn-profile-link rounded-2xl px-4 py-3 text-[#2A2A27] hover:bg-[#C4D9C6]/30 focus:bg-[#C4D9C6]/30">
                                    Profile Settings
                                </x-dropdown-link>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="px-2 pt-1">
                                @csrf

                                <x-dropdown-link
                                    :href="route('logout')"
                                    class="yn-profile-link rounded-2xl px-4 py-3 text-[#C87941] hover:bg-[#F0D5BC]/45 focus:bg-[#F0D5BC]/45"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                    <button
                        @click="open = ! open"
                        class="yn-mobile-toggle inline-flex items-center justify-center rounded-full border border-white/70 bg-white/70 p-3 text-[#3E5E42] shadow-sm focus:outline-none lg:hidden"
                        :aria-expanded="open.toString()"
                        aria-label="Toggle navigation"
                    >
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16M4 12h16M4 17h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 6l12 12M18 6L6 18" />
                        </svg>
                    </button>
                </div>

                <button
                    @click="open = ! open"
                    class="yn-mobile-toggle inline-flex items-center justify-center rounded-full border border-white/70 bg-white/70 p-3 text-[#3E5E42] shadow-sm focus:outline-none sm:hidden"
                    :aria-expanded="open.toString()"
                    aria-label="Toggle navigation"
                >
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16M4 12h16M4 17h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
            </div>

            <div x-show="open" x-transition.opacity.duration.200ms class="mt-4 border-t border-[#2A2A27]/10 pt-4 lg:hidden" style="display: none;">
                <div class="grid gap-2">
                    @foreach ($navLinks as $link)
                        <a
                            href="{{ $link['href'] }}"
                            class="yn-mobile-link rounded-2xl px-4 py-3 text-sm font-medium text-[#4F5A51] {{ $link['active'] ? 'yn-mobile-link-active' : 'bg-white/50 hover:bg-white/80' }}"
                            @if ($link['active']) aria-current="page" @endif
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="yn-menu-panel mt-4 rounded-[24px] px-4 py-4 sm:hidden">
                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-full bg-[#3E5E42] text-xs font-semibold uppercase tracking-[0.24em] text-[#FFFEF9]">
                            {{ $initials }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate font-semibold text-[#2A2A27]">{{ $user?->name }}</p>
                            <p class="truncate text-sm text-[#6B6B63]">{{ $user?->email }}</p>
                        </div>
                    </div>

                    <div class="mt-4 grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="yn-mobile-link rounded-2xl bg-white/60 px-4 py-3 text-sm font-medium text-[#2A2A27] hover:bg-white/85">
                            Profile Settings
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a
                                href="{{ route('logout') }}"
                                class="yn-mobile-link block rounded-2xl bg-[#F0D5BC]/45 px-4 py-3 text-sm font-medium text-[#C87941] hover:bg-[#F0D5BC]/65"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
