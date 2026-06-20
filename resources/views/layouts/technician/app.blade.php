<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Dashboard') | Ayos Agad</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet" />

    <style>
        :root {
            --blue-900: #1558E8;
            --blue-700: #2B80FF;
            --blue-500: #3DA0FF;
            --blue-400: #6BB8FF;
            --blue-200: #A8D8FF;
            --blue-50:  #E4F4FF;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--blue-50);
            color: #1e3a5f;
        }

        .font-display { font-family: 'Poppins', sans-serif; }

        [x-cloak] { display: none !important; }

        /* Sidebar nav links */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            border-radius: 0.65rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(255,255,255,0.75);
            transition: background 0.15s, color 0.15s;
        }
        .nav-link:hover  { background: rgba(255,255,255,0.10); color: #fff; }
        .nav-link.active {
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-weight: 600;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.15);
        }

        /* Light scrollbars */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--blue-200); border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--blue-400); }
    </style>

    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>

    @stack('styles')
</head>
<body class="antialiased">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        {{-- Mobile backdrop --}}
        <div
            x-show="sidebarOpen"
            x-cloak
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-[#0b1f4d]/50 lg:hidden"
        ></div>

        @include('layouts.technician.sidebar')

        <div class="flex-1 flex flex-col min-w-0">

            @include('layouts.navbar')

            <main class="flex-1 overflow-y-auto">
                <div class="max-w-10xl mx-auto p-4 sm:p-6 lg:p-8">

                    @hasSection('header')
                        <div class="mb-6">
                            @yield('header')
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="mb-6 rounded-xl bg-white border-l-4 px-4 py-3 text-sm shadow-sm" style="border-color: var(--blue-700);">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('content')

                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>