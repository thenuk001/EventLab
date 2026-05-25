<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Ticket Types
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $event->title }}
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('company.events.index') }}"
                   class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                    Back to Events
                </a>

                <a href="{{ route('company.events.tickets.create', $event) }}"
                   class="rounded-full bg-orange-500 px-5 py-2 text-sm font-bold text-white">
                    Add Ticket Type
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 p-4 font-bold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-blue-900 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">{{ $event->title }}</h1>
                <p class="mt-3 text-slate-200">
                    Manage ticket types, prices, capacity, and availability for this event.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @forelse($event->ticketTypes as $ticket)
                    <div class="rounded-3xl bg-white p-6 shadow">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-black">{{ $ticket->name }}</h3>
                                <p class="mt-2 text-3xl font-black text-orange-500">
                                    LKR {{ number_format($ticket->price, 2) }}
                                </p>
                            </div>

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                {{ str_replace('_', ' ', ucfirst($ticket->availability_status)) }}
                            </span>
                        </div>

                        <p class="mt-4 text-sm text-gray-500">
                            {{ $ticket->benefits ?? 'No benefits added.' }}
                        </p>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-bold text-gray-500">Quantity</p>
                                <p class="mt-1 text-xl font-black">{{ $ticket->quantity }}</p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-bold text-gray-500">Sold</p>
                                <p class="mt-1 text-xl font-black">{{ $ticket->sold_count }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('company.tickets.edit', $ticket) }}"
                               class="flex-1 rounded-full bg-slate-900 px-4 py-3 text-center text-sm font-bold text-white">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('company.tickets.destroy', $ticket) }}"
                                  class="flex-1"
                                  onsubmit="return confirm('Delete this ticket type?')">
                                @csrf
                                @method('DELETE')

                                <button class="w-full rounded-full bg-red-500 px-4 py-3 text-sm font-bold text-white">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 rounded-3xl bg-white p-10 text-center shadow">
                        <h3 class="text-2xl font-black">No ticket types yet</h3>
                        <p class="mt-2 text-gray-500">
                            Add Standard, VIP, Balcony, Zone, or custom ticket types.
                        </p>

                        <a href="{{ route('company.events.tickets.create', $event) }}"
                           class="mt-6 inline-flex rounded-full bg-orange-500 px-6 py-3 font-black text-white">
                            Add First Ticket Type
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>