<header class="bg-white border-b border-[var(--blue-50)] shadow-sm">
    <div class="h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">

        {{-- Left: mobile toggle + page title --}}
        <div class="flex items-center gap-3 min-w-0">
            <button
                @click="sidebarOpen = true"
                class="lg:hidden inline-flex items-center justify-center w-9 h-9 rounded-lg text-[var(--blue-700)] hover:bg-[var(--blue-50)] transition"
                aria-label="Open menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="min-w-0">
                <p class="font-display text-base sm:text-lg font-bold text-[#1e3a5f] truncate">
                    @yield('page-title', 'Dashboard')
                </p>
                <p class="hidden sm:block text-xs text-[#6b8fb5] truncate">
                    @yield('page-subtitle', now()->format('l, F j, Y'))
                </p>
            </div>
        </div>

        {{-- Center: search --}}
        <div class="hidden md:flex flex-1 max-w-md">
            <label class="relative w-full">
                <span class="sr-only">Search</span>
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[var(--blue-400)]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search services, bookings..."
                    class="w-full rounded-full border border-[var(--blue-200)] bg-[var(--blue-50)] pl-9 pr-4 py-2 text-sm text-[#1e3a5f] placeholder:text-[var(--blue-400)] focus:outline-none focus:ring-2 focus:ring-[var(--blue-400)] focus:bg-white transition"
                />
            </label>
        </div>

        {{-- Right: notifications + user --}}
        <div class="flex items-center gap-2 sm:gap-3">

            {{-- Notifications --}}
            <div x-data="{ open: false }" class="relative">
                <button
                    @click="open = !open"
                    @click.away="open = false"
                    :aria-expanded="open"
                    class="relative inline-flex items-center justify-center w-10 h-10 rounded-full text-[var(--blue-700)] hover:bg-[var(--blue-50)] transition"
                    aria-label="Notifications"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-[#e53e3e] ring-2 ring-white"></span>
                </button>

                <div
                    x-show="open"
                    x-cloak
                    x-transition
                    class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-lg border border-[var(--blue-50)] py-2 z-40"
                >
                    <p class="px-4 py-2 text-xs font-semibold uppercase tracking-wide text-[var(--blue-400)]">Notifications</p>
                    <a href="#" class="block px-4 py-2.5 text-sm text-[#1e3a5f] hover:bg-[var(--blue-50)]">
                        Your plumber booking is confirmed for 3:00 PM today.
                    </a>
                    <a href="#" class="block px-4 py-2.5 text-sm text-[#1e3a5f] hover:bg-[var(--blue-50)]">
                        New message from your electrician.
                    </a>
                    <a href="#" class="block px-4 py-2 text-center text-xs font-semibold text-[var(--blue-700)] hover:underline">
                        View all notifications
                    </a>
                </div>
            </div>

            <span class="hidden sm:block w-px h-8 bg-[var(--blue-50)]"></span>

            {{-- User dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button
                    @click="open = !open"
                    @click.away="open = false"
                    :aria-expanded="open"
                    class="flex items-center gap-2 rounded-full pl-1 pr-2 sm:pr-3 py-1 hover:bg-[var(--blue-50)] transition"
                >
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full font-display font-bold text-white text-sm"
                        style="background: linear-gradient(135deg, var(--blue-900), var(--blue-500));"
                    >
                        {{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 1)) }}
                    </span>
                    <span class="hidden sm:block text-sm font-semibold text-[#1e3a5f] max-w-[8rem] truncate">
                        {{ Auth::user()?->name ?? 'Account' }}
                    </span>
                    <svg class="hidden sm:block w-4 h-4 text-[var(--blue-400)]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-cloak
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-[var(--blue-50)] py-2 z-40"
                >
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[#1e3a5f] hover:bg-[var(--blue-50)]">
                        Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-[#1e3a5f] hover:bg-[var(--blue-50)]">
                        Settings
                    </a>
                    <hr class="my-1 border-[var(--blue-50)]" />
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#e53e3e] hover:bg-[var(--blue-50)]">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>