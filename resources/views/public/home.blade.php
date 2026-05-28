<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventLab | Chat. Book. Attend.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes floatSoft {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        @keyframes bubbleIn {
            0% {
                opacity: 0;
                transform: translateY(14px) scale(.96);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes typingPulse {
            0%, 80%, 100% { opacity: .25; transform: translateY(0); }
            40% { opacity: 1; transform: translateY(-4px); }
        }

        .marquee-track {
            animation: marquee 28s linear infinite;
        }

        .phone-float {
            animation: floatSoft 5s ease-in-out infinite;
        }

        .bubble-one {
            animation: bubbleIn .7s ease both;
            animation-delay: .2s;
        }

        .bubble-two {
            animation: bubbleIn .7s ease both;
            animation-delay: .8s;
        }

        .bubble-three {
            animation: bubbleIn .7s ease both;
            animation-delay: 1.4s;
        }

        .typing-dot {
            animation: typingPulse 1.4s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: .18s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: .36s;
        }
    </style>
</head>

<body class="bg-slate-950 text-white">
    <header class="sticky top-0 z-50 border-b border-white/10 bg-slate-950/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
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
                       class="hidden rounded-full bg-white/10 px-5 py-2 text-sm font-bold text-white hover:bg-white/20 sm:inline-flex">
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

    @if($featuredEvents->count())
        <section class="overflow-hidden border-b border-white/10 bg-orange-500 py-3 text-slate-950">
            <div class="marquee-track flex w-max items-center gap-8 whitespace-nowrap">
                @foreach(range(1, 2) as $loopRound)
                    @foreach($featuredEvents as $event)
                        <a href="{{ route('events.show', $event) }}"
                           class="flex items-center gap-3 text-sm font-black">
                            <span>🔥 Featured</span>
                            <span>{{ $event->title }}</span>
                            <span class="text-slate-700">•</span>
                            <span>{{ $event->event_date->format('M d') }}</span>
                            <span class="text-slate-700">•</span>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </section>
    @endif

    <main>
        <section class="relative overflow-hidden px-4 py-16 sm:px-6 md:py-24">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-700/30 via-orange-500/10 to-green-500/20"></div>
            <div class="absolute -left-20 top-20 h-72 w-72 rounded-full bg-orange-500/20 blur-3xl"></div>
            <div class="absolute -right-20 bottom-10 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

            <div class="relative mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">
                <div>
                    <p class="mb-5 inline-flex rounded-full border border-orange-400/40 bg-orange-400/10 px-4 py-2 text-sm font-bold text-orange-200">
                        WhatsApp-first event booking platform
                    </p>

                    <h1 class="text-4xl font-black leading-tight sm:text-5xl md:text-7xl">
                        Chat. Book.
                        <span class="text-orange-400">Attend.</span>
                    </h1>

                    <p class="mt-6 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">
                        Discover events, view ticket options, and start booking instantly through WhatsApp.
                        EventLab gives customers a faster and more familiar way to connect with organizers.
                    </p>

                    <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('events.index') }}"
                           class="rounded-full bg-orange-500 px-8 py-4 text-center font-black text-white hover:bg-orange-400">
                            Explore Events
                        </a>

                        <a href="#featured"
                           class="rounded-full bg-white/10 px-8 py-4 text-center font-black text-white hover:bg-white/20">
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

                <div class="phone-float">
                    <div class="mx-auto max-w-sm rounded-[2rem] border border-white/10 bg-slate-900 p-4 shadow-2xl shadow-green-500/20">
                        <div class="rounded-[1.5rem] bg-slate-950 p-5">
                            <div class="mb-5 flex items-center gap-3 border-b border-white/10 pb-4">
                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-green-500 text-xl">
                                    💬
                                </div>

                                <div>
                                    <p class="font-black">EventLab Booking</p>
                                    <p class="text-xs text-green-300">Online now</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="bubble-one max-w-[85%] rounded-2xl rounded-tl-sm bg-white/10 p-4 text-sm text-slate-200">
                                    Hi EventLab, I want to book tickets for the music night.
                                </div>

                                <div class="bubble-two ml-auto max-w-[85%] rounded-2xl rounded-tr-sm bg-green-500 p-4 text-sm font-bold text-white">
                                    Sure! Please send your name, ticket type, and quantity.
                                </div>

                                <div class="bubble-three max-w-[85%] rounded-2xl rounded-tl-sm bg-white/10 p-4 text-sm text-slate-200">
                                    Thenuk, VIP, 2 tickets.
                                </div>

                                <div class="ml-auto max-w-[70%] rounded-2xl rounded-tr-sm bg-green-500/90 p-4 text-sm font-bold text-white">
                                    Booking request received ✅
                                </div>

                                <div class="inline-flex items-center gap-1 rounded-full bg-white/10 px-4 py-3">
                                    <span class="typing-dot h-2 w-2 rounded-full bg-slate-300"></span>
                                    <span class="typing-dot h-2 w-2 rounded-full bg-slate-300"></span>
                                    <span class="typing-dot h-2 w-2 rounded-full bg-slate-300"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories" class="px-4 py-12 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-black uppercase tracking-widest text-orange-300">Browse</p>
                        <h2 class="mt-2 text-3xl font-black md:text-4xl">Popular Categories</h2>
                    </div>

                    <a href="{{ route('events.index') }}" class="font-bold text-orange-300 hover:text-orange-200">
                        View all events →
                    </a>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($categories as $category)
                        <a href="{{ route('events.index', ['category' => $category->slug]) }}"
                           class="rounded-3xl border border-white/10 bg-white/10 p-6 transition hover:-translate-y-1 hover:bg-white/15">
                            <div class="text-4xl">{{ $category->icon ?? '🎟️' }}</div>
                            <h3 class="mt-4 text-xl font-black">{{ $category->name }}</h3>
                            <p class="mt-2 text-sm text-slate-400">
                                Explore events under this category.
                            </p>
                        </a>
                    @empty
                        <div class="rounded-3xl border border-white/10 bg-white/10 p-6 text-slate-300">
                            No active categories yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="featured" class="px-4 py-12 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-black uppercase tracking-widest text-green-300">Hot picks</p>
                        <h2 class="mt-2 text-3xl font-black md:text-4xl">Featured Events</h2>
                    </div>

                    <a href="{{ route('events.index') }}" class="font-bold text-green-300 hover:text-green-200">
                        Explore events →
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($featuredEvents as $event)
                        @php
                            $lowestPrice = $event->ticketTypes->min('price');
                        @endphp

                        <a href="{{ route('events.show', $event) }}"
                           class="group overflow-hidden rounded-3xl border border-white/10 bg-white/10 transition hover:-translate-y-1 hover:bg-white/15">
                            <div class="flex h-52 items-center justify-center bg-gradient-to-br from-purple-700 via-orange-500 to-green-500">
                                <span class="text-7xl transition group-hover:scale-110">
                                    {{ $event->category?->icon ?? '🎟️' }}
                                </span>
                            </div>

                            <div class="p-6">
                                <div class="mb-3 flex flex-wrap gap-2">
                                    <span class="rounded-full bg-orange-500/20 px-3 py-1 text-xs font-bold text-orange-200">
                                        Featured
                                    </span>

                                    <span class="rounded-full bg-purple-500/20 px-3 py-1 text-xs font-bold text-purple-200">
                                        {{ $event->category?->name }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-black">{{ $event->title }}</h3>

                                <p class="mt-3 text-sm leading-6 text-slate-300">
                                    {{ $event->event_date->format('M d, Y') }} • {{ $event->city }}
                                </p>

                                <div class="mt-5 flex items-center justify-between">
                                    <span class="text-sm font-bold text-slate-400">
                                        @if($lowestPrice)
                                            From LKR {{ number_format($lowestPrice, 2) }}
                                        @else
                                            Ticket info soon
                                        @endif
                                    </span>

                                    <span class="font-black text-orange-300">
                                        View →
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-3xl border border-white/10 bg-white/10 p-8 text-slate-300">
                            No featured events yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="px-4 py-12 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-black uppercase tracking-widest text-purple-300">New</p>
                        <h2 class="mt-2 text-3xl font-black md:text-4xl">Latest Events</h2>
                    </div>

                    <a href="{{ route('events.index') }}" class="font-bold text-purple-300 hover:text-purple-200">
                        See all →
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($latestEvents as $event)
                        @php
                            $lowestPrice = $event->ticketTypes->min('price');
                        @endphp

                        <a href="{{ route('events.show', $event) }}"
                           class="rounded-3xl border border-white/10 bg-white/10 p-6 transition hover:-translate-y-1 hover:bg-white/15">
                            <div class="text-5xl">{{ $event->category?->icon ?? '🎟️' }}</div>
                            <h3 class="mt-5 text-xl font-black">{{ $event->title }}</h3>

                            <p class="mt-3 text-sm leading-6 text-slate-300">
                                {{ $event->event_date->format('M d, Y') }} • {{ $event->venue }} • {{ $event->city }}
                            </p>

                            <p class="mt-5 text-sm font-bold text-orange-300">
                                @if($lowestPrice)
                                    From LKR {{ number_format($lowestPrice, 2) }}
                                @else
                                    Ticket info soon
                                @endif
                            </p>
                        </a>
                    @empty
                        <div class="rounded-3xl border border-white/10 bg-white/10 p-8 text-slate-300">
                            No latest events yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="how-it-works" class="px-4 py-16 sm:px-6">
            <div class="mx-auto max-w-7xl rounded-[2rem] border border-white/10 bg-white/10 p-8 md:p-12">
                <div class="max-w-3xl">
                    <p class="text-sm font-black uppercase tracking-widest text-orange-300">How it works</p>
                    <h2 class="mt-3 text-3xl font-black md:text-5xl">
                        Book events in a way customers already know.
                    </h2>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    <div class="rounded-3xl bg-slate-950/60 p-6">
                        <div class="text-4xl">🔎</div>
                        <h3 class="mt-4 text-xl font-black">Find Event</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Browse public events and view event details, prices, and ticket types.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-950/60 p-6">
                        <div class="text-4xl">💬</div>
                        <h3 class="mt-4 text-xl font-black">Chat on WhatsApp</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Tap the booking button and start a WhatsApp conversation with EventLab.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-950/60 p-6">
                        <div class="text-4xl">🎟️</div>
                        <h3 class="mt-4 text-xl font-black">Attend Event</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Booking is confirmed by the team, and QR tickets can be checked at entrance.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-white/10 px-4 py-8 text-center text-sm text-slate-400 sm:px-6">
        © {{ date('Y') }} EventLab. Built for WhatsApp-first event booking.
    </footer>
</body>
</html>