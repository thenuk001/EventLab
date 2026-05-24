<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events | EventLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white">
    <header class="border-b border-white/10 bg-slate-950/90">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="{{ route('home') }}" class="text-2xl font-black">
                Event<span class="text-orange-400">Lab</span>
            </a>

            <a href="{{ route('login') }}" class="rounded-full bg-green-500 px-5 py-2 text-sm font-bold">
                Admin Login
            </a>
        </div>
    </header>

    <section class="mx-auto max-w-7xl px-6 py-12">
        <div class="mb-8">
            <p class="text-sm font-bold uppercase tracking-widest text-orange-300">
                Event Discovery
            </p>
            <h1 class="mt-2 text-5xl font-black">Find Your Next Event</h1>
            <p class="mt-3 text-slate-400">
                Browse events and start booking instantly through WhatsApp.
            </p>
        </div>

        <form method="GET" class="mb-10 grid gap-4 rounded-3xl border border-white/10 bg-white/10 p-5 md:grid-cols-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search event, venue, city..."
                class="rounded-2xl border border-white/10 bg-slate-900 px-4 py-3 text-white placeholder:text-slate-500"
            >

            <select
                name="category"
                class="rounded-2xl border border-white/10 bg-slate-900 px-4 py-3 text-white"
            >
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button class="rounded-2xl bg-orange-500 px-4 py-3 font-black text-white hover:bg-orange-400">
                Search Events
            </button>
        </form>

        <div class="grid gap-6 md:grid-cols-3">
            @forelse($events as $event)
                <article class="overflow-hidden rounded-3xl border border-white/10 bg-white/10 shadow-xl">
                    <div class="flex h-56 items-center justify-center bg-gradient-to-br from-purple-700 via-orange-500 to-green-500">
                        <span class="text-6xl">{{ $event->category->icon ?? '🎟️' }}</span>
                    </div>

                    <div class="p-6">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="rounded-full bg-purple-500/20 px-3 py-1 text-xs font-bold text-purple-200">
                                {{ $event->category->name }}
                            </span>

                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-bold text-green-200">
                                Available
                            </span>
                        </div>

                        <h2 class="text-2xl font-black">{{ $event->title }}</h2>

                        <p class="mt-3 text-sm text-slate-300">
                            {{ $event->event_date->format('M d, Y') }}
                            @if($event->start_time)
                                • {{ \Illuminate\Support\Str::of($event->start_time)->substr(0, 5) }}
                            @endif
                        </p>

                        <p class="mt-1 text-sm text-slate-400">
                            {{ $event->venue }} • {{ $event->city }}
                        </p>

                        <div class="mt-6 flex gap-3">
                            <a
                                href="{{ route('events.show', $event) }}"
                                class="flex-1 rounded-full bg-white/10 px-4 py-3 text-center text-sm font-bold hover:bg-white/20"
                            >
                                View Details
                            </a>

                            <a
                                href="{{ route('events.show', $event) }}"
                                class="flex-1 rounded-full bg-green-500 px-4 py-3 text-center text-sm font-bold hover:bg-green-400"
                            >
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 rounded-3xl border border-white/10 bg-white/10 p-10 text-center">
                    <p class="text-slate-300">No events found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $events->links() }}
        </div>
    </section>
</body>
</html>