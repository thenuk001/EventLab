<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->title }} | EventLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white">
    <header class="sticky top-0 z-50 border-b border-white/10 bg-slate-950/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="text-2xl font-black">
                Event<span class="text-orange-400">Lab</span>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}"
                   class="hidden rounded-full bg-white/10 px-5 py-2 text-sm font-bold hover:bg-white/20 sm:inline-flex">
                    Home
                </a>

                <a href="{{ route('events.index') }}"
                   class="rounded-full bg-orange-500 px-5 py-2 text-sm font-black text-white hover:bg-orange-400">
                    Back to Events
                </a>
            </div>
        </div>
    </header>

    <section class="relative overflow-hidden px-4 py-10 sm:px-6 sm:py-14">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-700/30 via-orange-500/10 to-green-500/20"></div>
        <div class="absolute -left-20 top-24 h-72 w-72 rounded-full bg-orange-500/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-10 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>

        <div class="relative mx-auto mb-6 max-w-7xl">
            <a href="{{ route('events.index') }}"
               class="inline-flex items-center rounded-full bg-white/10 px-5 py-2 text-sm font-bold text-slate-200 hover:bg-white/20">
                ← Back to Events
            </a>
        </div>

        <div class="relative mx-auto grid max-w-7xl gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/10 shadow-2xl">
                    <div class="flex h-64 items-center justify-center bg-gradient-to-br from-purple-700 via-orange-500 to-green-500 sm:h-80">
                        <span class="text-7xl sm:text-8xl">{{ $event->category?->icon ?? '🎟️' }}</span>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="mb-4 flex flex-wrap gap-2">
                            <span class="rounded-full bg-purple-500/20 px-3 py-1 text-xs font-bold text-purple-200">
                                {{ $event->category?->name }}
                            </span>

                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-bold text-green-200">
                                Verified Organizer
                            </span>

                            <span class="rounded-full bg-orange-500/20 px-3 py-1 text-xs font-bold text-orange-200">
                                {{ $event->event_code }}
                            </span>
                        </div>

                        <h1 class="text-3xl font-black leading-tight sm:text-5xl">
                            {{ $event->title }}
                        </h1>

                        <p class="mt-5 text-base leading-7 text-slate-300 sm:text-lg">
                            {{ $event->event_date->format('M d, Y') }}

                            @if($event->start_time)
                                • {{ \Illuminate\Support\Str::of($event->start_time)->substr(0, 5) }}
                            @endif

                            • {{ $event->venue }}
                            • {{ $event->city }}
                        </p>

                        <div class="mt-8 rounded-3xl bg-slate-900/80 p-6">
                            <h2 class="text-2xl font-black">About Event</h2>

                            <p class="mt-3 leading-7 text-slate-300">
                                {{ $event->description }}
                            </p>
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl bg-slate-900/80 p-6">
                                <h2 class="text-xl font-black">Organizer</h2>

                                <p class="mt-3 text-slate-300">
                                    {{ $event->company?->name }}
                                </p>
                            </div>

                            <div class="rounded-3xl bg-slate-900/80 p-6">
                                <h2 class="text-xl font-black">Location</h2>

                                <p class="mt-3 text-slate-300">
                                    {{ $event->venue }} • {{ $event->city }}
                                </p>

                                @if($event->map_url)
                                    <a href="{{ $event->map_url }}"
                                       target="_blank"
                                       class="mt-4 inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-white hover:bg-white/20">
                                        Open Map
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="rounded-3xl border border-white/10 bg-white/10 p-6 shadow-xl">
                    <h2 class="text-2xl font-black">Book This Event</h2>

                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        Tap the button below to start your booking through WhatsApp.
                        Event details will be added automatically.
                    </p>

                    @if($event->ticketTypes->count())
                        <div class="mt-6 space-y-3">
                            <p class="text-sm font-bold uppercase tracking-widest text-slate-400">
                                Ticket Types
                            </p>

                            @foreach($event->ticketTypes as $ticket)
                                <div class="rounded-2xl bg-slate-900 p-4">
                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <h3 class="font-black text-white">{{ $ticket->name }}</h3>

                                            @if($ticket->benefits)
                                                <p class="mt-1 text-sm text-slate-400">
                                                    {{ $ticket->benefits }}
                                                </p>
                                            @endif

                                            <span class="mt-3 inline-flex rounded-full bg-green-500/20 px-3 py-1 text-xs font-bold text-green-200">
                                                {{ str_replace('_', ' ', ucfirst($ticket->availability_status)) }}
                                            </span>
                                        </div>

                                        <p class="whitespace-nowrap text-lg font-black text-orange-300">
                                            LKR {{ number_format($ticket->price, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-6 rounded-2xl bg-slate-900 p-5 text-sm text-slate-300">
                            Ticket information will be updated soon.
                        </div>
                    @endif

                    <a href="{{ route('events.whatsapp', ['event' => $event, 'source_page' => 'event_detail']) }}"
                       target="_blank"
                       class="mt-6 block rounded-full bg-green-500 px-6 py-4 text-center text-lg font-black text-white hover:bg-green-400">
                        {{ $event->whatsappCta?->cta_label ?? 'Book on WhatsApp' }}
                    </a>

                    <div class="mt-6 rounded-2xl bg-slate-900 p-5">
                        <p class="text-sm font-bold text-slate-400">Event Code</p>
                        <p class="mt-2 text-2xl font-black text-orange-300">
                            {{ $event->event_code }}
                        </p>
                    </div>

                    <div class="mt-4 rounded-2xl bg-slate-900 p-5">
                        <p class="text-sm font-bold text-slate-400">Booking Method</p>
                        <p class="mt-2 font-black text-green-300">
                            WhatsApp booking via EventLab
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </section>
</body>
</html>