<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ayos Agad — Sign In</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet" />

    <style>
        /* ── Blue palette extracted from swatch ── */
        :root {
            --blue-900: #1558E8;   /* darkest — col 1 */
            --blue-700: #2B80FF;   /* vivid — col 2 */
            --blue-500: #3DA0FF;   /* sky — col 3   */
            --blue-400: #6BB8FF;   /* mid — col 5   */
            --blue-200: #A8D8FF;   /* pale — col 7  */
            --blue-50:  #E4F4FF;   /* near-white     */
            --white:    #FFFFFF;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--blue-900) 0%, var(--blue-700) 55%, var(--blue-400) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .font-display { font-family: 'Poppins', sans-serif; }

        /* ── Card ── */
        .card {
            width: 100%;
            max-width: 920px;
            min-height: 560px;
            background: white;
            border-radius: 1.75rem;
            box-shadow: 0 32px 80px rgba(21, 88, 232, 0.35);
            display: flex;
            overflow: hidden;
        }

        /* ── Left panel ── */
        .panel-left {
            position: relative;
            width: 52%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
            overflow: hidden;
            background: linear-gradient(155deg, var(--blue-900) 0%, var(--blue-700) 55%, var(--blue-500) 100%);
        }

        /* Floating circles */
        @keyframes floatA {
            0%,100% { transform: translateY(0px) scale(1); }
            50%      { transform: translateY(-22px) scale(1.06); }
        }
        @keyframes floatB {
            0%,100% { transform: translateY(0px) scale(1); }
            50%      { transform: translateY(16px) scale(0.95); }
        }
        @keyframes floatC {
            0%,100% { transform: translateY(0px); }
            50%      { transform: translateY(-12px); }
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(4px);
        }
        .c1 { width:160px; height:160px; top:6%;  left:12%;  animation: floatA 7s ease-in-out infinite; }
        .c2 { width:100px; height:100px; top:42%; left:-5%;  animation: floatB 9s ease-in-out infinite; background: rgba(255,255,255,0.10); }
        .c3 { width: 55px; height: 55px; top:30%; left:58%;  animation: floatC 5s ease-in-out infinite; background: rgba(255,255,255,0.28); }
        .c4 { width: 75px; height: 75px; bottom:18%; left:38%; animation: floatA 6s ease-in-out infinite 1s; background: rgba(255,255,255,0.14); }
        .c5 { width:120px; height:120px; bottom:-2%; right:-8%; animation: floatB 8s ease-in-out infinite 2s; background: rgba(255,255,255,0.08); }

        /* Wave at bottom of left panel */
        .wave-wrap {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 90px;
            overflow: hidden;
        }
        .wave-wrap svg { width: 100%; height: 100%; }

        /* Service icons strip */
        .services-row {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
        }
        .service-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.3rem 0.65rem;
            border-radius: 999px;
            letter-spacing: 0.02em;
            backdrop-filter: blur(6px);
        }

        /* ── Right panel ── */
        .panel-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3.5rem 3rem;
        }

        /* Input underline style */
        .input-line {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 2px solid var(--blue-200);
            outline: none;
            padding: 0.6rem 0 0.5rem;
            font-size: 0.9rem;
            color: #1e3a5f;
            transition: border-color 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .input-line:focus { border-bottom-color: var(--blue-700); }
        .input-line::placeholder { color: var(--blue-400); font-size: 0.85rem; }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            border: none;
            border-radius: 0.6rem;
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: white;
            background: linear-gradient(90deg, var(--blue-900) 0%, var(--blue-700) 100%);
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 6px 20px rgba(21, 88, 232, 0.4);
        }
        .btn-submit:hover  { opacity: 0.9; transform: translateY(-1px); }
        .btn-submit:active { opacity: 0.85; transform: translateY(0); }
        .btn-submit:focus  { outline: 3px solid var(--blue-400); outline-offset: 2px; }

        /* Checkbox */
        .custom-check {
            accent-color: var(--blue-700);
            width: 14px; height: 14px;
        }

        /* Fade-up animation */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fu  { animation: fadeUp 0.5s ease both; }
        .d1  { animation-delay: 0.08s; }
        .d2  { animation-delay: 0.16s; }
        .d3  { animation-delay: 0.24s; }
        .d4  { animation-delay: 0.32s; }
        .d5  { animation-delay: 0.40s; }
        .d6  { animation-delay: 0.48s; }

        /* Responsive — stack on mobile */
        @media (max-width: 640px) {
            .panel-left { display: none; }
            .card { min-height: auto; border-radius: 1.25rem; }
            .panel-right { padding: 2.5rem 1.75rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            .c1,.c2,.c3,.c4,.c5 { animation: none; }
            .fu { animation: none; opacity: 1; }
        }
    </style>
</head>

<body>
<div class="card">

    {{-- ══════════════════════════════════
         LEFT PANEL
    ══════════════════════════════════ --}}
    <div class="panel-left">

        <!-- Circles -->
        <div class="circle c1"></div>
        <div class="circle c2"></div>
        <div class="circle c3"></div>
        <div class="circle c4"></div>
        <div class="circle c5"></div>

        <!-- Wave bottom -->
        <div class="wave-wrap">
            <svg viewBox="0 0 480 90" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,45 C80,90 200,0 320,55 C400,90 440,20 480,45 L480,90 L0,90 Z"
                      fill="rgba(255,255,255,0.10)" />
                <path d="M0,60 C120,20 280,80 480,35 L480,90 L0,90 Z"
                      fill="rgba(255,255,255,0.07)" />
            </svg>
        </div>

        <!-- Brand wordmark -->
        <div style="position:relative; z-index:10;">
            <span class="font-display" style="color:rgba(255,255,255,0.55); font-size:0.7rem; letter-spacing:0.2em; text-transform:uppercase; font-weight:700;">
                Ayos Agad
            </span>
        </div>

        <!-- Center headline -->
        <div style="position:relative; z-index:10; text-align:center;">
            <p style="color:rgba(255,255,255,0.65); font-size:0.75rem; font-weight:500; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:0.6rem;">
                Home Services, On-Demand
            </p>
            <h1 class="font-display" style="color:white; font-size:2.4rem; font-weight:900; line-height:1.15; text-shadow:0 2px 20px rgba(0,0,0,0.2);">
                Ayos<br/>Agad
            </h1>
            <p style="color:rgba(255,255,255,0.70); font-size:0.82rem; margin-top:0.75rem; line-height:1.5;">
                Sign in to book trusted professionals<br/>straight to your door.
            </p>

            <!-- Service chips -->
            <div class="services-row" style="justify-content:center; margin-top:1.4rem;">
                <span class="service-chip">🔧 Plumber</span>
                <span class="service-chip">⚡ Electrician</span>
                <span class="service-chip">🪣 Painter</span>
                <span class="service-chip">🪚 Carpenter</span>
                <span class="service-chip">📱 Technician</span>
            </div>
        </div>

        <!-- Footer url -->
        <div style="position:relative; z-index:10; text-align:center;">
            <p style="color:rgba(255,255,255,0.40); font-size:0.65rem; letter-spacing:0.18em; text-transform:uppercase;">
                www.ayosagad.com
            </p>
        </div>
    </div>

    {{-- ══════════════════════════════════
         RIGHT PANEL
    ══════════════════════════════════ --}}
    <div class="panel-right">

        <!-- Greeting -->
        <div class="fu" style="margin-bottom:1.6rem;">
            <p style="color:#6b8fb5; font-size:0.85rem; font-weight:500;">Hello !</p>
            <p class="font-display" style="color:var(--blue-700); font-size:1.3rem; font-weight:800; line-height:1.2;">
                @php
                    $hour = now()->hour;
                    echo match(true) {
                        $hour <  12 => 'Good Morning ☀️',
                        $hour <  17 => 'Good Afternoon 🌤',
                        default     => 'Good Evening 🌙',
                    };
                @endphp
            </p>
        </div>

        <!-- Sub-title -->
        <div class="fu d1" style="margin-bottom:2rem;">
            <h2 style="font-size:1rem; font-weight:600; color:#1e3a5f;">
                <span style="color:var(--blue-700);">Login</span> to Your Account
            </h2>
        </div>

        <!-- Validation errors -->
        @if ($errors->any())
            <div class="fu" style="margin-bottom:1rem; color:#e53e3e; font-size:0.78rem; line-height:1.6;">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" style="display:flex; flex-direction:column; gap:1.4rem;">
            @csrf

            <!-- Email -->
            <div class="fu d2">
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email Address"
                    autocomplete="email"
                    required
                    class="input-line"
                />
            </div>

            <!-- Password -->
            <div class="fu d3">
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Password"
                    autocomplete="current-password"
                    required
                    class="input-line"
                />
            </div>

            <!-- Remember + Forgot -->
            <div class="fu d4" style="display:flex; align-items:center; justify-content:space-between; font-size:0.78rem; color:#6b8fb5;">
                <label style="display:flex; align-items:center; gap:0.4rem; cursor:pointer;">
                    <input type="checkbox" name="remember" class="custom-check" />
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       style="color:var(--blue-700); text-decoration:none; font-weight:500; transition:opacity 0.15s;"
                       onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Sign In -->
            <div class="fu d5">
                <button type="submit" class="btn-submit">Sign In</button>
            </div>
        </form>

        <!-- Create account -->
        @if (Route::has('register'))
            <p class="fu d6" style="text-align:center; font-size:0.78rem; color:#6b8fb5; margin-top:1.25rem;">
                Don't have an account?&nbsp;
                <a href="{{ route('register') }}"
                   style="color:var(--blue-700); font-weight:600; text-decoration:none;"
                   onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    Create Account
                </a>
            </p>
        @endif

    </div>
</div>
</body>
</html>