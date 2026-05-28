<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | EventLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950">
    <div class="min-h-screen bg-slate-950 text-white">
        <div class="grid min-h-screen lg:grid-cols-2">
            <!-- Left Branding Panel -->
            <div class="relative hidden overflow-hidden lg:flex">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-purple-950 to-orange-600"></div>
                <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-orange-500/30 blur-3xl"></div>
                <div class="absolute right-10 top-40 h-96 w-96 rounded-full bg-purple-500/30 blur-3xl"></div>
                <div class="absolute bottom-10 left-32 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

                <div class="relative z-10 flex w-full flex-col justify-between p-12">
                    <div>
                        <a href="{{ route('home') }}" class="text-4xl font-black tracking-tight">
                            Event<span class="text-orange-400">Lab</span>
                        </a>

                        <p class="mt-4 text-lg font-semibold text-slate-300">
                            Chat. Book. Attend.
                        </p>
                    </div>

                    <div class="max-w-2xl">
                        <span class="inline-flex rounded-full border border-white/20 bg-white/10 px-5 py-2 text-sm font-bold text-orange-200">
                            Admin Access Portal
                        </span>

                        <h1 class="mt-6 text-5xl font-black leading-tight xl:text-6xl">
                            Manage your event operations in one secure place.
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">
                            Access approvals, companies, event management, bookings, WhatsApp enquiries,
                            and QR check-ins through the EventLab admin system.
                        </p>

                        <div class="mt-10 grid gap-4 xl:grid-cols-3">
                            <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                <p class="text-xs font-black uppercase tracking-widest text-orange-300">
                                    Role 01
                                </p>
                                <h3 class="mt-3 text-xl font-black">
                                    Super Admin
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-300">
                                    Manage companies, users, event approvals, and platform control.
                                </p>
                            </div>

                            <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                <p class="text-xs font-black uppercase tracking-widest text-green-300">
                                    Role 02
                                </p>
                                <h3 class="mt-3 text-xl font-black">
                                    Company Admin
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-300">
                                    Create events, manage tickets, WhatsApp CTA, enquiries, and bookings.
                                </p>
                            </div>

                            <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                <p class="text-xs font-black uppercase tracking-widest text-purple-300">
                                    Role 03
                                </p>
                                <h3 class="mt-3 text-xl font-black">
                                    Support Staff
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-300">
                                    Handle customer enquiries, follow-ups, and QR ticket check-ins.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-sm text-slate-400">
                        © {{ date('Y') }} EventLab. Built for WhatsApp-first event booking.
                    </div>
                </div>
            </div>

            <!-- Login Panel -->
            <div class="flex min-h-screen items-center justify-center bg-slate-100 px-4 py-10 sm:px-6 lg:px-10">
                <div class="w-full max-w-xl">
                    <!-- Mobile Logo -->
                    <div class="mb-8 text-center lg:hidden">
                        <a href="{{ route('home') }}" class="text-4xl font-black tracking-tight text-slate-950">
                            Event<span class="text-orange-500">Lab</span>
                        </a>
                        <p class="mt-2 text-sm font-semibold text-slate-500">
                            Admin Access Portal
                        </p>
                    </div>

                    <div class="rounded-[2rem] bg-white p-6 shadow-2xl sm:p-8">
                        <div class="mb-8">
                            <p class="text-sm font-black uppercase tracking-widest text-orange-500">
                                Secure Login
                            </p>

                            <h2 class="mt-2 text-3xl font-black text-slate-950 sm:text-4xl">
                                Welcome Back
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Select your admin portal and sign in with your assigned EventLab account.
                            </p>
                        </div>

                        <!-- Portal Selector -->
                        <div class="mb-8">
                            <p class="mb-3 text-sm font-bold text-slate-600">
                                Choose your portal
                            </p>

                            <div class="grid gap-3 sm:grid-cols-3">
                                <button type="button"
                                        data-portal="super_admin"
                                        class="portal-btn rounded-2xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-orange-400 hover:bg-orange-50">
                                    <p class="text-xs font-black uppercase tracking-widest text-orange-500">
                                        Portal
                                    </p>
                                    <h3 class="mt-2 text-sm font-black text-slate-950">
                                        Super Admin
                                    </h3>
                                </button>

                                <button type="button"
                                        data-portal="company_admin"
                                        class="portal-btn rounded-2xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-green-400 hover:bg-green-50">
                                    <p class="text-xs font-black uppercase tracking-widest text-green-500">
                                        Portal
                                    </p>
                                    <h3 class="mt-2 text-sm font-black text-slate-950">
                                        Company Admin
                                    </h3>
                                </button>

                                <button type="button"
                                        data-portal="support_staff"
                                        class="portal-btn rounded-2xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-purple-400 hover:bg-purple-50">
                                    <p class="text-xs font-black uppercase tracking-widest text-purple-500">
                                        Portal
                                    </p>
                                    <h3 class="mt-2 text-sm font-black text-slate-950">
                                        Support Staff
                                    </h3>
                                </button>
                            </div>

                            <div class="mt-4 rounded-2xl bg-slate-100 px-4 py-3 text-sm text-slate-600">
                                Selected portal:
                                <span id="portalLabel" class="font-black text-slate-950">
                                    Super Admin
                                </span>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="mb-6 rounded-2xl bg-green-50 p-4 text-sm font-bold text-green-700">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-6 rounded-2xl bg-red-50 p-4 text-sm text-red-700">
                                <ul class="list-inside list-disc space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <input type="hidden" name="portal" id="portalInput" value="super_admin">

                            <div>
                                <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                                    Email
                                </label>

                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus
                                       autocomplete="username"
                                       class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-200">
                            </div>

                            <div>
                                <label for="password" class="mb-2 block text-sm font-bold text-slate-700">
                                    Password
                                </label>

                                <input id="password"
                                       type="password"
                                       name="password"
                                       required
                                       autocomplete="current-password"
                                       class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-200">
                            </div>

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <label for="remember_me" class="inline-flex items-center gap-2">
                                    <input id="remember_me"
                                           type="checkbox"
                                           name="remember"
                                           class="rounded border-slate-300 text-orange-500 shadow-sm focus:ring-orange-400">

                                    <span class="text-sm text-slate-600">
                                        Remember me
                                    </span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-sm font-bold text-slate-600 underline hover:text-orange-500">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit"
                                    class="w-full rounded-2xl bg-slate-950 px-6 py-4 text-center text-sm font-black uppercase tracking-widest text-white transition hover:bg-orange-500">
                                Log In to Portal
                            </button>
                        </form>

                        <div class="mt-8 rounded-2xl bg-slate-50 p-4 text-sm leading-6 text-slate-500">
                            Use the correct account for your assigned role. After login, EventLab will redirect you
                            to the correct dashboard automatically.
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('home') }}" class="text-sm font-bold text-slate-500 hover:text-orange-500">
                            ← Back to EventLab Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const portalButtons = document.querySelectorAll('.portal-btn');
        const portalInput = document.getElementById('portalInput');
        const portalLabel = document.getElementById('portalLabel');

        const portalMap = {
            super_admin: 'Super Admin',
            company_admin: 'Company Admin',
            support_staff: 'Support Staff'
        };

        function resetButton(button) {
            button.classList.remove(
                'ring-2',
                'ring-orange-400',
                'ring-green-400',
                'ring-purple-400',
                'border-orange-400',
                'border-green-400',
                'border-purple-400',
                'bg-orange-50',
                'bg-green-50',
                'bg-purple-50'
            );
        }

        function setActivePortal(portal) {
            portalInput.value = portal;
            portalLabel.textContent = portalMap[portal];

            portalButtons.forEach(button => {
                resetButton(button);

                if (button.dataset.portal === portal) {
                    if (portal === 'super_admin') {
                        button.classList.add('ring-2', 'ring-orange-400', 'border-orange-400', 'bg-orange-50');
                    }

                    if (portal === 'company_admin') {
                        button.classList.add('ring-2', 'ring-green-400', 'border-green-400', 'bg-green-50');
                    }

                    if (portal === 'support_staff') {
                        button.classList.add('ring-2', 'ring-purple-400', 'border-purple-400', 'bg-purple-50');
                    }
                }
            });
        }

        portalButtons.forEach(button => {
            button.addEventListener('click', () => {
                setActivePortal(button.dataset.portal);
            });
        });

        setActivePortal('{{ old('portal', 'super_admin') }}');
    </script>
</body>
</html>