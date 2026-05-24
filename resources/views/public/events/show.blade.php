<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->title }} | EventLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white">
    <header class="border-b border-white/10 bg-slate-950/90">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="{{ route('home') }}" class="text-2xl font-black">
                Event<span class="text-orange-400">Lab</span>
            </a>

            <a href="{{ route('events.index') }}" class="rounded-full bg-white/10 px-5 py-2 text-sm font-bold">
                Back to Events
            </a>
        </div>
    </header>

    <section class="relative overflow-hidden px-6 py-14">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-700/30 via-orange-500/10 to-green-500/20"></div>

        <div class="relative mx-auto grid max-w-7xl gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/10">
                    <div class="flex h-80 items-center justify-center bg-gradient-to-br from-purple-700 via-orange-500 to-green-500">
                        <span class="text-8xl">{{ $event->category->icon ?? '🎟️' }}</span>
                    </div>

                    <div class="p-8">
                        <div class="mb-4 flex flex-wrap gap-2">
                            <span class="rounded-full bg-purple-500/20 px-3 py-1 text-xs font-bold text-purple-200">
                                {{ $event->category->name }}
                            </span>

                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-bold text-green-200">
                                Verified Organizer
                            </span>

                            <span class="rounded-full bg-orange-500/20 px-3 py-1 text-xs font-bold text-orange-200">
                                {{ $event->event_code }}
                            </span>
                        </div>

                        <h1 class="text-5xl font-black">{{ $event->title }}</h1>

                        <p class="mt-5 text-lg text-slate-300">
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

                        <div class="mt-6 rounded-3xl bg-slate-900/80 p-6">
                            <h2 class="text-2xl font-black">Organizer</h2>
                            <p class="mt-3 text-slate-300">
                                {{ $event->company->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="lg:sticky lg:top-8 lg:self-start">
                <div class="rounded-3xl border border-white/10 bg-white/10 p-6 shadow-xl">
                    <h2 class="text-2xl font-black">Book This Event</h2>

                    <p class="mt-3 text-sm text-slate-300">
                        Start your booking through WhatsApp. Event details will be included in the message.
                    </p>

                    @php
                        $phone = $event->company->whatsapp_number ?? '94771234567';

                        $message = "Hello EventLab, I would like to book tickets for {$event->title}. "
                            . "Event ID: {$event->event_code}. "
                            . "Date: {$event->event_date->format('Y-m-d')}. "
                            . "Ticket Type: [Standard/VIP/etc.]. "
                            . "Quantity: [ ]. "
                            . "My name is [ ]. "
                            . "Please confirm availability and payment details.";

                        $waUrl = 'https://wa.me/' . $phone . '?text=' . urlencode($message);
                    @endphp

                    <a
                        href="{{ $waUrl }}"
                        target="_blank"
                        class="mt-6 block rounded-full bg-green-500 px-6 py-4 text-center text-lg font-black hover:bg-green-400"
                    >
                        Book on WhatsApp
                    </a>

                    <div class="mt-6 rounded-2xl bg-slate-900 p-5">
                        <p class="text-sm font-bold text-slate-400">Event Code</p>
                        <p class="mt-2 text-2xl font-black text-orange-300">{{ $event->event_code }}</p>
                    </div>

                    <div class="mt-4 rounded-2xl bg-slate-900 p-5">
                        <p class="text-sm font-bold text-slate-400">Booking Phone</p>
                        <p class="mt-2 font-black text-green-300">{{ $phone }}</p>
                    </div>
                </div>
            </aside>
        </div>
    </section>
</body>
</html>