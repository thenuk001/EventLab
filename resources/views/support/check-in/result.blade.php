<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Ticket Result
            </h2>

            <a href="{{ route('support.check-in.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Search Again
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-orange-800 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">Ticket Verification</h1>
                <p class="mt-3 text-slate-200">
                    Review ticket details before confirming check-in.
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="rounded-3xl bg-white p-8 shadow lg:col-span-2">
                    <div class="mb-6 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-bold text-gray-500">Ticket Code</p>
                            <h2 class="mt-1 text-3xl font-black">{{ $qrTicket->ticket_code }}</h2>
                        </div>

                        @if($qrTicket->status === 'valid')
                            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-bold text-green-700">
                                Valid
                            </span>
                        @elseif($qrTicket->status === 'checked_in')
                            <span class="rounded-full bg-blue-100 px-4 py-2 text-sm font-bold text-blue-700">
                                Already Checked In
                            </span>
                        @else
                            <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-bold text-red-700">
                                Cancelled
                            </span>
                        @endif
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-5">
                            <p class="text-sm font-bold text-gray-500">Event</p>
                            <p class="mt-1 text-lg font-black">{{ $qrTicket->event?->title }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $qrTicket->event?->event_code }}</p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-5">
                            <p class="text-sm font-bold text-gray-500">Ticket Type</p>
                            <p class="mt-1 text-lg font-black">{{ $qrTicket->ticketType?->name ?? 'N/A' }}</p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-5">
                            <p class="text-sm font-bold text-gray-500">Customer</p>
                            <p class="mt-1 text-lg font-black">{{ $qrTicket->booking?->customer_name ?? $qrTicket->holder_name }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $qrTicket->booking?->customer_phone }}</p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-5">
                            <p class="text-sm font-bold text-gray-500">Booking</p>
                            <p class="mt-1 text-lg font-black">{{ $qrTicket->booking?->booking_code }}</p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ str_replace('_', ' ', ucfirst($qrTicket->booking?->payment_status ?? 'unknown')) }}
                            </p>
                        </div>
                    </div>

                    @if($qrTicket->checked_in_at)
                        <div class="mt-6 rounded-2xl bg-blue-50 p-5">
                            <p class="text-sm font-bold text-blue-700">Checked In At</p>
                            <p class="mt-1 font-black text-blue-900">
                                {{ $qrTicket->checked_in_at->format('M d, Y h:i A') }}
                            </p>
                        </div>
                    @endif
                </div>

                <aside class="rounded-3xl bg-slate-900 p-6 text-white shadow">
                    <p class="text-sm font-black uppercase tracking-widest text-green-300">
                        Action
                    </p>

                    <h3 class="mt-2 text-2xl font-black">
                        Check-in Status
                    </h3>

                    @if($qrTicket->status === 'valid')
                        <p class="mt-4 text-sm leading-6 text-slate-300">
                            This ticket is valid. Confirm only after the customer is physically present.
                        </p>

                        <form method="POST"
                              action="{{ route('support.check-in.confirm', $qrTicket) }}"
                              class="mt-6"
                              onsubmit="return confirm('Confirm check-in for this ticket?')">
                            @csrf

                            <button class="w-full rounded-full bg-green-500 px-6 py-4 text-lg font-black text-white hover:bg-green-400">
                                Confirm Check-in
                            </button>
                        </form>
                    @elseif($qrTicket->status === 'checked_in')
                        <div class="mt-6 rounded-2xl bg-blue-500/20 p-5 text-blue-100">
                            This ticket has already been checked in.
                        </div>
                    @else
                        <div class="mt-6 rounded-2xl bg-red-500/20 p-5 text-red-100">
                            This ticket is cancelled and cannot be checked in.
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>