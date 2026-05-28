<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | EventLab</title>
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
                            Secure Account Recovery
                        </span>

                        <h1 class="mt-6 text-5xl font-black leading-tight xl:text-6xl">
                            Recover access to your EventLab admin portal.
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">
                            Enter your registered admin email address and EventLab will send a secure password reset link.
                            This keeps Super Admin, Company Admin, and Support Staff accounts protected.
                        </p>

                        <div class="mt-10 grid gap-4 xl:grid-cols-3">
                            <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                <p class="text-xs font-black uppercase tracking-widest text-orange-300">
                                    Step 01
                                </p>
                                <h3 class="mt-3 text-xl font-black">
                                    Enter Email
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-300">
                                    Use your registered EventLab admin email address.
                                </p>
                            </div>

                            <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                <p class="text-xs font-black uppercase tracking-widest text-green-300">
                                    Step 02
                                </p>
                                <h3 class="mt-3 text-xl font-black">
                                    Open Link
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-300">
                                    Check your email or local Laravel log for the reset link.
                                </p>
                            </div>

                            <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                <p class="text-xs font-black uppercase tracking-widest text-purple-300">
                                    Step 03
                                </p>
                                <h3 class="mt-3 text-xl font-black">
                                    Set Password
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-300">
                                    Create a new password and return to the admin portal.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-sm text-slate-400">
                        © {{ date('Y') }} EventLab. Secure admin access recovery.
                    </div>
                </div>
            </div>

            <!-- Reset Form Panel -->
            <div class="flex min-h-screen items-center justify-center bg-slate-100 px-4 py-10 sm:px-6 lg:px-10">
                <div class="w-full max-w-xl">
                    <!-- Mobile Logo -->
                    <div class="mb-8 text-center lg:hidden">
                        <a href="{{ route('home') }}" class="text-4xl font-black tracking-tight text-slate-950">
                            Event<span class="text-orange-500">Lab</span>
                        </a>
                        <p class="mt-2 text-sm font-semibold text-slate-500">
                            Secure Account Recovery
                        </p>
                    </div>

                    <div class="rounded-[2rem] bg-white p-6 shadow-2xl sm:p-8">
                        <div class="mb-8">
                            <p class="text-sm font-black uppercase tracking-widest text-orange-500">
                                Password Reset
                            </p>

                            <h2 class="mt-2 text-3xl font-black text-slate-950 sm:text-4xl">
                                Forgot your password?
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                No problem. Enter your EventLab admin email address and we will send a secure reset link
                                so you can create a new password.
                            </p>
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

                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                                    Admin Email Address
                                </label>

                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus
                                       autocomplete="username"
                                       placeholder="example@eventlab.lk"
                                       class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-200">
                            </div>

                            <button type="submit"
                                    class="w-full rounded-2xl bg-slate-950 px-6 py-4 text-center text-sm font-black uppercase tracking-widest text-white transition hover:bg-orange-500">
                                Email Password Reset Link
                            </button>
                        </form>

                        <div class="mt-8 rounded-2xl bg-slate-50 p-4 text-sm leading-6 text-slate-500">
                            Local testing note: if your mail driver is set to
                            <span class="font-black text-slate-800">log</span>,
                            the reset link will appear in
                            <span class="font-black text-slate-800">storage/logs/laravel.log</span>.
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col items-center justify-center gap-3 text-center sm:flex-row">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-500 hover:text-orange-500">
                            ← Back to Login
                        </a>

                        <span class="hidden text-slate-300 sm:inline">•</span>

                        <a href="{{ route('home') }}" class="text-sm font-bold text-slate-500 hover:text-orange-500">
                            Back to EventLab Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>