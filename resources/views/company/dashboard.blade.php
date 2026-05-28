<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.25em] text-green-600">
                    EventLab Company Center
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    Company Admin Dashboard
                </h2>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('events.index') }}"
                   target="_blank"
                   class="rounded-full bg-slate-100 px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-200">
                    View Public Events
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="rounded-full bg-orange-500 px-5 py-2.5 text-sm font-black text-white hover:bg-orange-400">
                    Profile
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">
        <div class="mx-auto max-w-7xl px-4">

            <!-- Hero Section -->
            <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl md:p-10">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950 to-green-600"></div>
                <div class="absolute -left-16 top-10 h-72 w-72 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute right-10 bottom-0 h-72 w-72 rounded-full bg-orange-500/25 blur-3xl"></div>
                <div class="absolute right-40 top-10 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-3 lg:items-center">
                    <div class="lg:col-span-2">
                        <div class="mb-5 inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-bold text-green-200">
                            Company Admin Portal
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            {{ $company?->name ?? 'Company Dashboard' }}
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Manage your events, ticket types, WhatsApp booking settings, customer enquiries,
                            confirmed bookings, and QR check-ins from one clean workspace.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('company.events.index') }}"
                               class="rounded-full bg-white px-7 py-3 text-center text-sm font-black text-slate-950 hover:bg-slate-100">
                                Manage Events
                            </a>

                            <a href="{{ route('company.events.create') }}"
                               class="rounded-full bg-orange-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                                Create Event
                            </a>

                            <a href="{{ route('company.enquiries.index') }}"
                               class="rounded-full bg-green-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-green-400">
                                View Enquiries
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-300">
                            Company Status
                        </p>

                        <div class="mt-5 flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-500 text-2xl font-black">
                                {{ strtoupper(substr($company?->name ?? 'EL', 0, 2)) }}
                            </div>

                            <div>
                                <h3 class="text-xl font-black">
                                    {{ $company?->name ?? 'EventLab Company' }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-300">
                                    Event management access enabled
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs font-bold text-slate-300">Events</p>
                                <p class="mt-1 text-2xl font-black">{{ $activeEvents }}</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs font-bold text-slate-300">Bookings</p>
                                <p class="mt-1 text-2xl font-black">{{ $bookings }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Active Events
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                            🎟️
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-slate-950">
                        {{ $activeEvents }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Published and approved events
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            WhatsApp Clicks
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-2xl">
                            💬
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-green-600">
                        {{ $whatsappClicks }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Customer booking button clicks
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Bookings
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-2xl">
                            🧾
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-orange-500">
                        {{ $bookings }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Confirmed customer bookings
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            QR Check-ins
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-2xl">
                            ✅
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-purple-600">
                        {{ $qrCheckIns }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Tickets checked at entrance
                    </p>
                </div>
            </div>

            <!-- Main Action Cards -->
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                <a href="{{ route('company.events.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-3xl">
                                🎤
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Event Management
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                View, create, update, and monitor all your company events.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-blue-500 group-hover:text-white">
                            Open →
                        </span>
                    </div>
                </a>

                <a href="{{ route('company.events.create') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-3xl">
                                ➕
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Create New Event
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Add a new event and send it for Super Admin approval before publishing.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-orange-500 group-hover:text-white">
                            Create →
                        </span>
                    </div>
                </a>

                <a href="{{ route('company.enquiries.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-3xl">
                                💬
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                WhatsApp Enquiries
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Track customer WhatsApp booking interest and convert enquiries into bookings.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-green-500 group-hover:text-white">
                            View →
                        </span>
                    </div>
                </a>

                <a href="{{ route('company.bookings.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-3xl">
                                🧾
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Bookings
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                View confirmed bookings, generated QR tickets, and customer booking details.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-purple-500 group-hover:text-white">
                            Open →
                        </span>
                    </div>
                </a>

                <a href="{{ route('company.events.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-3xl">
                                🎫
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                Ticket Types
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Select an event and manage Standard, VIP, Zone, Balcony, and other ticket types.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-teal-500 group-hover:text-white">
                            Manage →
                        </span>
                    </div>
                </a>

                <a href="{{ route('company.events.index') }}"
                   class="group rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-pink-100 text-3xl">
                                📲
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-950">
                                WhatsApp Settings
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Select an event and customize the WhatsApp CTA label and booking message template.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600 group-hover:bg-pink-500 group-hover:text-white">
                            Setup →
                        </span>
                    </div>
                </a>
            </div>

            <!-- Workflow + Tips -->
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-6 shadow lg:col-span-2 md:p-8">
                    <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                                Company Workflow
                            </p>

                            <h2 class="mt-2 text-3xl font-black text-slate-950">
                                Recommended event publishing flow
                            </h2>
                        </div>

                        <a href="{{ route('company.events.create') }}"
                           class="rounded-full bg-orange-500 px-5 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                            Start New Event
                        </a>
                    </div>

                    <div class="grid gap-4 md:grid-cols-4">
                        <div class="rounded-3xl bg-slate-100 p-5">
                            <p class="text-sm font-black text-blue-500">01</p>

                            <h3 class="mt-2 font-black text-slate-950">
                                Create Event
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Add event details, venue, date, and category.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-slate-100 p-5">
                            <p class="text-sm font-black text-green-500">02</p>

                            <h3 class="mt-2 font-black text-slate-950">
                                Add Tickets
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Add ticket types after creating the event.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-slate-100 p-5">
                            <p class="text-sm font-black text-purple-500">03</p>

                            <h3 class="mt-2 font-black text-slate-950">
                                Setup WhatsApp
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Configure booking message and CTA label.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-slate-100 p-5">
                            <p class="text-sm font-black text-orange-500">04</p>

                            <h3 class="mt-2 font-black text-slate-950">
                                Track Bookings
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Convert enquiries and generate QR tickets.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-slate-950 p-6 text-white shadow md:p-8">
                    <p class="text-sm font-black uppercase tracking-[0.25em] text-green-300">
                        Quick Tip
                    </p>

                    <h3 class="mt-3 text-2xl font-black">
                        Keep your events ready for approval
                    </h3>

                    <p class="mt-4 text-sm leading-7 text-slate-300">
                        Events become public only after Super Admin approval. Add clear descriptions,
                        accurate dates, correct ticket prices, and proper WhatsApp templates to avoid rejection.
                    </p>

                    <div class="mt-6 rounded-2xl bg-white/10 p-4">
                        <p class="text-sm font-bold text-slate-200">
                            Best practice:
                        </p>

                        <p class="mt-2 text-sm leading-6 text-slate-300">
                            Always check ticket types and WhatsApp settings immediately after creating an event.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>