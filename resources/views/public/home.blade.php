<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventLab | Chat. Book. Attend.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white">
    <header class="sticky top-0 z-50 border-b border-white/10 bg-slate-950/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight">
                Event<span class="text-orange-400">Lab</span>
            </a>

            <nav class="hidden items-center gap-8 md:flex">
                <a href="{{ route('events.index') }}" class="text-sm font-bold text-slate-300 hover:text-white">
                    Events
                </a>

                <a href="#categories" class="text-sm font-bold text-slate-300 hover:text-white">
                    Categories
                </a>

                <a href="#how-it-works" class="text-sm font-bold text-slate-300 hover:text-white">
                    How it works
                </a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="rounded-full bg-orange-500 px-5 py-2 text-sm font-black text-white hover:bg-orange-400">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden rounded-full bg-white/10 px-5 py-2 text-sm font-bold text-white hover:bg-white/20 md:inline-flex">
                        Admin Login
                    </a>

                    <a href="{{ route('events.index') }}"
                       class="rounded-full bg-green-500 px-5 py-2 text-sm font-black text-white hover:bg-green-400">
                        Book Events
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <section class="relative overflow-hidden px-6 py-20 md:py-28">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-700/30 via-orange-500/10 to-green-500/20"></div>
            <div class="absolute -left-20 top-20 h-72 w-72 rounded-full bg-orange-500/20 blur-3xl"></div>
            <div class="absolute -right-20 bottom-10 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

            <div class="relative mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">
                <div>
                    <p class="mb-5 inline-flex rounded-full border border-orange-400/40 bg-orange-400/10 px-4 py-2 text-sm font-bold text-orange-200">
                        WhatsApp-first event booking platform
                    </p>

                    <h1 class="text-5xl font-black leading-tight md:text-7xl">
                        Chat. Book.
                        <span class="text-orange-400">Attend.</span>
                    </h1>

                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                        Discover events, view ticket options, and start booking instantly through WhatsApp.
                        EventLab gives customers a faster and more familiar way to connect with organizers.
                    </p>

                    <div class="mt-9 flex flex-wrap gap-4">
                        <a href="{{ route('events.index') }}"
                           class="rounded-full bg-orange-500 px-8 py-4 font-black text-white hover:bg-orange-400">
                            Explore Events
                        </a>

                        <a href="#featured"
                           class="rounded-full bg-white/10 px-8 py-4 font-black text-white hover:bg-white/20">
                            Featured Events
                        </a>
                    </div>

                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                            <p class="text-3xl font-black text-orange-300">{{ $featuredEvents->count() }}</p>
                            <p class="mt-1 text-sm text-slate-300">Featured Events</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                            <p class="text-3xl font-black text-green-300">{{ $categories->count() }}</p>
                            <p class="mt-1 text-sm text-slate-300">Categories</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                            <p class="text-3xl font-black text-purple-300">24/7</p>
                            <p class="mt-1 text-sm text-slate-300">WhatsApp Flow</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="rounded-[1.5rem] bg-slate-900 p-6">
                        <div class="mb-5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-slate-400">Live Booking Preview</p>
                                <h2 class="text-2xl font-black">WhatsApp Experience</h2>
                            </div>

                            <span class="rounded-full bg-green-500 px-3 py-1 text-xs font-black">
                                Online
                            </span>
                        </div>

                        <div class="space-y-4">
                            <div class="max-w-xs rounded-2xl bg-slate-800 p-4 text-sm">
                                Hi, I want to book VIP tickets for the music night.
                            </div>

                            <div class="ml-auto max-w-xs rounded-2xl bg-green-500 p-4 text-sm font-bold">
                                Sure! Please confirm quantity and your name.
                            </div>

                            <div class="max-w-xs rounded-2xl bg-slate-800 p-4 text-sm">
                                2 tickets. Name: Thenuk.
                            </div>

                            <div class="ml-auto max-w-xs rounded-2xl bg-green-500 p-4 text-sm font-bold">
                                Great. Your booking request is received.
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl bg-white/5 p-4">
                            <p class="text-sm text-slate-400">
                                No complicated checkout for MVP. Customers start from WhatsApp and organizers continue the booking conversation.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories" class="mx-auto max-w-7xl px-6 py-16">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-black uppercase tracking-widest text-orange-300">
                        Browse by vibe
                    </p>
                    <h2 class="mt-2 text-4xl font-black">Event Categories</h2>
                </div>

                <a href="{{ route('events.index') }}" class="hidden text-sm font-black text-orange-300 md:block">
                    View all events →
                </a>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                @forelse($categories as $category)
                    <a href="{{ route('events.index', ['category' => $category->slug]) }}"
                       class="group rounded-3xl border border-white/10 bg-white/10 p-6 transition hover:-translate-y-1 hover:bg-white/20">
                        <div class="text-4xl">{{ $category->icon ?? '🎟️' }}</div>

                        <h3 class="mt-5 text-lg font-black">
                            {{ $category->name }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            {{ $category->description }}
                        </p>
                    </a>
                @empty
                    <p class="text-slate-400">No categories yet.</p>
                @endforelse
            </div>
        </section>

        <section id="featured" class="mx-auto max-w-7xl px-6 py-16">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-black uppercase tracking-widest text-green-300">
                        Approved and featured
                    </p>
                    <h2 class="mt-2 text-4xl font-black">Featured Events</h2>
                </div>

                <a href="{{ route('events.index') }}" class="hidden rounded-full bg-white/10 px-5 py-2 text-sm font-black text-white hover:bg-white/20 md:block">
                    Browse All
                </a>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @forelse($featuredEvents as $event)
                    <article class="overflow-hidden rounded-3xl border border-white/10 bg-white/10 shadow-xl">
                        <div class="flex h-56 items-center justify-center bg-gradient-to-br from-purple-700 via-orange-500 to-green-500">
                            <span class="text-6xl">{{ $event->category->icon ?? '🎟️' }}</span>
                        </div>

                        <div class="p-6">
                            <div class="mb-3 flex items-center justify-between gap-3">
                                <span class="rounded-full bg-purple-500/20 px-3 py-1 text-xs font-bold text-purple-200">
                                    {{ $event->category->name }}
                                </span>

                                <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-bold text-green-200">
                                    Approved
                                </span>
                            </div>

                            <h3 class="text-2xl font-black">{{ $event->title }}</h3>

                            <p class="mt-3 text-sm text-slate-300">
                                {{ $event->event_date->format('M d, Y') }}
                                @if($event->start_time)
                                    • {{ \Illuminate\Support\Str::of($event->start_time)->substr(0, 5) }}
                                @endif
                            </p>

                            <p class="mt-1 text-sm text-slate-400">
                                {{ $event->venue }} • {{ $event->city }}
                            </p>

                            @if($event->ticketTypes->count())
                                <p class="mt-4 text-sm font-bold text-orange-300">
                                    From LKR {{ number_format($event->ticketTypes->min('price'), 2) }}
                                </p>
                            @endif

                            <div class="mt-6 flex gap-3">
                                <a href="{{ route('events.show', $event) }}"
                                   class="flex-1 rounded-full bg-white/10 px-4 py-3 text-center text-sm font-bold hover:bg-white/20">
                                    Details
                                </a>

                                <a href="{{ route('events.show', $event) }}"
                                   class="flex-1 rounded-full bg-green-500 px-4 py-3 text-center text-sm font-black hover:bg-green-400">
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-white/10 bg-white/10 p-8 text-slate-300">
                        No featured events yet. Approve and feature events from the Super Admin panel.
                    </div>
                @endforelse
            </div>
        </section>

        <section id="how-it-works" class="mx-auto max-w-7xl px-6 py-16">
            <div class="rounded-[2rem] border border-white/10 bg-white/10 p-8 md:p-10">
                <p class="text-sm font-black uppercase tracking-widest text-orange-300">
                    Simple user journey
                </p>
                <h2 class="mt-2 text-4xl font-black">How EventLab Works</h2>

                <div class="mt-8 grid gap-6 md:grid-cols-4">
                    <div class="rounded-3xl bg-slate-900 p-6">
                        <div class="text-3xl">🔎</div>
                        <h3 class="mt-4 font-black">Discover</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Users browse public events and categories.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-900 p-6">
                        <div class="text-3xl">🎟️</div>
                        <h3 class="mt-4 font-black">Choose</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            They check event details and ticket types.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-900 p-6">
                        <div class="text-3xl">💬</div>
                        <h3 class="mt-4 font-black">Chat</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Booking starts instantly through WhatsApp.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-900 p-6">
                        <div class="text-3xl">✅</div>
                        <h3 class="mt-4 font-black">Attend</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Organizer confirms booking and customer attends.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 py-16">
            <div class="mx-auto max-w-5xl rounded-[2rem] bg-gradient-to-r from-orange-500 to-green-500 p-10 text-center shadow-2xl">
                <h2 class="text-4xl font-black">Ready to find your next event?</h2>
                <p class="mx-auto mt-4 max-w-2xl text-white/90">
                    Explore approved events and start booking through WhatsApp in seconds.
                </p>

                <a href="{{ route('events.index') }}"
                   class="mt-8 inline-flex rounded-full bg-slate-950 px-8 py-4 font-black text-white hover:bg-slate-900">
                    Browse Events
                </a>
            </div>
        </section>
    </main>

    <footer class="border-t border-white/10 px-6 py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
            <p>© {{ date('Y') }} EventLab. Chat. Book. Attend.</p>

            <div class="flex gap-5">
                <a href="{{ route('events.index') }}" class="hover:text-white">Events</a>
                <a href="{{ route('login') }}" class="hover:text-white">Admin Login</a>
            </div>
        </div>
    </footer>
</body>
</html>