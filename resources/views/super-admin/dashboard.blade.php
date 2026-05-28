<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-widest text-orange-500">
                    EventLab Control Center
                </p>
                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    Super Admin Dashboard
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}"
                   target="_blank"
                   class="rounded-full bg-slate-100 px-5 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200">
                    View Public Site
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="rounded-full bg-orange-500 px-5 py-2 text-sm font-black text-white hover:bg-orange-400">
                    Profile
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">
        <div class="mx-auto max-w-7xl px-4">

            <!-- Hero Section -->
            <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl md:p-10">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-purple-950 to-orange-600"></div>
                <div class="absolute -left-16 top-10 h-72 w-72 rounded-full bg-orange-500/30 blur-3xl"></div>
                <div class="absolute right-10 bottom-0 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-3 lg:items-center">
                    <div class="lg:col-span-2">
                        <div class="mb-5 inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-bold text-orange-200">
                            Super Admin Portal
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            Event<span class="text-orange-400">Lab</span> Platform Management
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Manage companies, users, event approvals, featured events, bookings, WhatsApp enquiries,
                            and platform reports from one secure dashboard.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('super.events.index') }}"
                               class="rounded-full bg-orange-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                                Review Event Approvals
                            </a>

                            <a href="{{ route('super.companies.index') }}"
                               class="rounded-full bg-white/10 px-7 py-3 text-center text-sm font-black text-white hover:bg-white/20">
                                Manage Companies
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-widest text-green-300">
                            Current Role
                        </p>

                        <div class="mt-5 flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-500 text-3xl font-black">
                                EL
                            </div>

                            <div>
                                <h3 class="text-xl font-black">
                                    EventLab Super Admin
                                </h3>
                                <p class="mt-1 text-sm text-slate-300">
                                    Full platform access enabled
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl bg-slate-950/60 p-4">
                            <p class="text-sm text-slate-300">
                                Use the quick action cards below to access every Super Admin module without typing URLs.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Total Companies
                        </p>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-xl">
                            🏢
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-slate-950">
                        {{ $totalCompanies }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        All registered companies
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Approved Companies
                        </p>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-green-100 text-xl">
                            ✅
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-green-600">
                        {{ $approvedCompanies }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Companies ready to operate
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Pending Companies
                        </p>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-xl">
                            ⏳
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-orange-500">
                        {{ $pendingCompanies }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Waiting for approval
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Total Users
                        </p>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-xl">
                            👥
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-purple-600">
                        {{ $totalUsers }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Platform admin accounts
                    </p>
                </div>
            </div>

            <!-- Main Navigation Cards -->
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                <a href="{{ route('super.events.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-3xl">
                                🎟️
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Event Approvals
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Review submitted events, approve or reject them, add comments, and feature important events.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-orange-500 group-hover:text-white">
                            Open →
                        </span>
                    </div>
                </a>

                <a href="{{ route('super.events.create') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-3xl">
                                ➕
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Create Event
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Create an event on behalf of a company when they need Super Admin support.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-green-500 group-hover:text-white">
                            Create →
                        </span>
                    </div>
                </a>

                <a href="{{ route('super.companies.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-3xl">
                                🏢
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Company Management
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Add companies, approve access, activate, deactivate, block, and manage company status.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-blue-500 group-hover:text-white">
                            Open →
                        </span>
                    </div>
                </a>

                <a href="{{ route('super.companies.create') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-3xl">
                                🧾
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Add Company
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Register a new event company and prepare it for approval and admin assignment.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-teal-500 group-hover:text-white">
                            Add →
                        </span>
                    </div>
                </a>

                <a href="{{ route('super.users.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-3xl">
                                👤
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                User Management
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Create and manage Super Admin, Company Admin, and Support Staff user accounts.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-purple-500 group-hover:text-white">
                            Open →
                        </span>
                    </div>
                </a>

                <a href="{{ route('super.users.create') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-pink-100 text-3xl">
                                🔐
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Add Admin User
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Create Company Admin or Support Staff accounts and assign the correct role.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-pink-500 group-hover:text-white">
                            Add →
                        </span>
                    </div>
                </a>

                <a href="{{ route('super.reports.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl lg:col-span-2">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                                📊
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Platform Reports
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                View platform activity, booking counts, WhatsApp clicks, events, users, companies,
                                and operational insights.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-slate-950 group-hover:text-white">
                            Reports →
                        </span>
                    </div>
                </a>

                <a href="{{ route('dashboard') }}"
                   class="group rounded-[1.5rem] bg-slate-950 p-6 text-white shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-3xl">
                                ⚡
                            </div>

                            <h3 class="mt-5 text-2xl font-black">
                                Smart Redirect
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-300">
                                Test the global dashboard redirect based on the logged-in user's assigned role.
                            </p>
                        </div>

                        <span class="rounded-full bg-white/10 px-4 py-2 text-sm font-black text-white group-hover:bg-orange-500">
                            Test →
                        </span>
                    </div>
                </a>
            </div>

            <!-- Workflow Section -->
            <div class="mt-8 rounded-[2rem] bg-white p-6 shadow md:p-8">
                <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-sm font-black uppercase tracking-widest text-orange-500">
                            Super Admin Workflow
                        </p>

                        <h2 class="mt-2 text-3xl font-black text-slate-950">
                            Recommended review process
                        </h2>
                    </div>

                    <a href="{{ route('super.events.index') }}"
                       class="rounded-full bg-orange-500 px-5 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                        Start Reviewing
                    </a>
                </div>

                <div class="grid gap-4 md:grid-cols-4">
                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-orange-500">01</p>
                        <h3 class="mt-2 font-black text-slate-950">Approve Company</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Review company details and activate approved companies.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-green-500">02</p>
                        <h3 class="mt-2 font-black text-slate-950">Create Admins</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Add company admins and support staff users.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-purple-500">03</p>
                        <h3 class="mt-2 font-black text-slate-950">Review Events</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Approve or reject events before public visibility.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-blue-500">04</p>
                        <h3 class="mt-2 font-black text-slate-950">Monitor Reports</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Track bookings, enquiries, clicks, and platform activity.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>