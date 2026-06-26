<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-40 w-72 shrink-0 flex flex-col overflow-hidden transform transition-transform duration-300 ease-in-out lg:static lg:translate-x-0"
    style="background: linear-gradient(155deg, var(--blue-900) 0%, var(--blue-700) 55%, var(--blue-500) 100%);"
>
    {{-- decorative circles, matching the auth pages --}}
    <div class="absolute rounded-full pointer-events-none" style="width:180px; height:180px; top:-4rem; right:-4rem; background:rgba(255,255,255,0.08);"></div>
    <div class="absolute rounded-full pointer-events-none" style="width:120px; height:120px; bottom:5rem; left:-3rem; background:rgba(255,255,255,0.06);"></div>

    {{-- Brand --}}
    <div class="relative z-10 flex items-center justify-between px-6 py-6">
        <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2.5">
            <img
                src="{{ asset('images/ayos-agad-logo.svg') }}"
                alt="Ayos Agad Logo"
                class="h-10 w-auto"
            >

            <span class="font-display font-extrabold text-lg tracking-tight text-white">
                Ayos Agad
            </span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden text-white/70 hover:text-white transition" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="relative z-10 flex-1 overflow-y-auto px-4 pb-4 space-y-1">

        <p class="px-3 pt-2 pb-1 text-[0.65rem] font-semibold tracking-[0.2em] uppercase text-white/40">Menu</p>

        <a href="{{ route('admin_dashboard') }}" class="nav-link {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="#" class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            <span>My Bookings</span>
        </a>
        

        <a href="{{ route('admin.technicians.index') }}" class="nav-link {{ request()->routeIs('admin.technicians.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 0 1 11.545-7.586" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 14.487A3 3 0 1 0 13 18.349l.342.342a.75.75 0 0 0 1.06 0l4.5-4.5a.75.75 0 0 0 0-1.06l-.342-.342a3 3 0 0 0-1.698-.302Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 21 15l-3 3-1.5-1.5" />
            </svg>
            <span>Manage Technicians</span>
        </a>

        <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l5.653-4.655m5.8-5.8 2.998 2.998a1.5 1.5 0 0 1 0 2.122l-.879.879a1.5 1.5 0 0 1-2.122 0l-2.998-2.998m5.8-5.8L17.25 3A2.652 2.652 0 0 0 13.5 6.75l-1.42 1.42m5.8-5.8-2.122 2.12" />
            </svg>
            <span>Manage Services</span>
        </a>

        <a href="#" class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
            </svg>
            <span>Messages</span>
            <span class="ml-auto inline-flex items-center justify-center w-5 h-5 rounded-full bg-white text-[10px] font-bold" style="color: var(--blue-700);">3</span>
        </a>

        <p class="px-3 pt-5 pb-1 text-[0.65rem] font-semibold tracking-[0.2em] uppercase text-white/40">Account</p>

        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span>Profile</span>
        </a>

        <a href="#" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
            <span>Settings</span>
        </a>

    </nav>

    {{-- CTA + Logout --}}
    <div class="relative z-10 px-4 pb-6 pt-2 space-y-3 border-t border-white/10">
        <a href="#" class="flex items-center justify-center gap-2 rounded-xl bg-white/15 hover:bg-white/25 transition text-white text-sm font-semibold py-2.5 mt-3 backdrop-blur">
            <span>🔧</span> Book a Service
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link w-full text-left cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H3" />
                </svg>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>