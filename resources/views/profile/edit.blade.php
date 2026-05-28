<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-widest text-orange-500">
                    EventLab Account Center
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    Profile Settings
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                   class="rounded-full bg-slate-100 px-5 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200">
                    Back to Dashboard
                </a>

                <a href="{{ route('home') }}"
                   target="_blank"
                   class="rounded-full bg-orange-500 px-5 py-2 text-sm font-black text-white hover:bg-orange-400">
                    View Site
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl md:p-10">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-purple-950 to-orange-600"></div>
                <div class="absolute -left-16 top-10 h-72 w-72 rounded-full bg-orange-500/30 blur-3xl"></div>
                <div class="absolute right-10 bottom-0 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-3 lg:items-center">
                    <div class="lg:col-span-2">
                        <div class="mb-5 inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-bold text-orange-200">
                            Secure Profile Management
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            Manage your Event<span class="text-orange-400">Lab</span> account
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Update your profile information, change your password, and manage your account security
                            from one clean profile center.
                        </p>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-widest text-green-300">
                            Signed in as
                        </p>

                        <div class="mt-5 flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-500 text-2xl font-black">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>

                            <div>
                                <h3 class="text-xl font-black">
                                    {{ auth()->user()->name }}
                                </h3>
                                <p class="mt-1 text-sm text-slate-300">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl bg-slate-950/60 p-4">
                            <p class="text-sm text-slate-300">
                                Keep your account details updated and use a strong password to protect EventLab access.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="space-y-8 lg:col-span-2">
                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-3xl">
                            🔐
                        </div>

                        <h3 class="mt-5 text-2xl font-black text-slate-950">
                            Security Tips
                        </h3>

                        <ul class="mt-5 space-y-4 text-sm leading-6 text-slate-500">
                            <li class="flex gap-3">
                                <span class="font-black text-orange-500">01</span>
                                Use a password with letters, numbers, and symbols.
                            </li>

                            <li class="flex gap-3">
                                <span class="font-black text-green-500">02</span>
                                Do not share your admin login with anyone.
                            </li>

                            <li class="flex gap-3">
                                <span class="font-black text-purple-500">03</span>
                                Update your password if you suspect unusual access.
                            </li>
                        </ul>
                    </div>

                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>