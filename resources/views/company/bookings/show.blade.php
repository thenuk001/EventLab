<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Booking Details
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $booking->booking_code }}
                </p>
            </div>

            <a href="{{ route('company.bookings.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Back to Bookings
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-green-600 p-8 text-white">
                <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-black uppercase tracking-widest text-green-300">
                            Confirmed Booking
                        </p>

                        <h1 class="mt-2 text-4xl font-black">
                            {{ $booking->booking_code }}
                        </h1>

                        <p class="mt-3 text-slate-200">
                            {{ $booking->event?->title }} • {{ $booking->event?->event_code }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-5">
                        <p class="text-sm text-slate-300">Total Amount</p>
                        <p class="mt-1 text-3xl font-black text-orange-300">
                            LKR {{ number_format($booking->total_amount, 2) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="space-y-8 lg:col-span-2">
                    <div class="rounded-3xl bg-white p-8 shadow">
                        <h3 class="text-2xl font-black">Customer Details</h3>

                        <div class="mt-6 grid gap-5 md:grid-cols-2">
                            <div class="rounded-2xl bg-gray-50 p-5">
                                <p class="text-sm font-bold text-gray-500">Name</p>
                                <p class="mt-1 text-lg font-black">
                                    {{ $booking->customer_name ?? 'Not provided' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-5">
                                <p class="text-sm font-bold text-gray-500">Phone</p>
                                <p class="mt-1 text-lg font-black">
                                    {{ $booking->customer_phone ?? 'Not provided' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-5">
                                <p class="text-sm font-bold text-gray-500">Email</p>
                                <p class="mt-1 text-lg font-black">
                                    {{ $booking->customer_email ?? 'Not provided' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-5">
                                <p class="text-sm font-bold text-gray-500">Quantity</p>
                                <p class="mt-1 text-lg font-black">
                                    {{ $booking->quantity }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-8 shadow">
                        <h3 class="text-2xl font-black">QR Tickets</h3>

                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            @foreach($booking->qrTickets as $ticket)
                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm font-bold text-gray-500">Ticket Code</p>
                                            <p class="mt-1 text-xl font-black text-slate-900">
                                                {{ $ticket->ticket_code }}
                                            </p>
                                        </div>

                                        @if($ticket->status === 'checked_in')
                                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                                Checked In
                                            </span>
                                        @elseif($ticket->status === 'cancelled')
                                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                                Valid
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4 rounded-xl bg-white p-4">
                                        <p class="text-sm font-bold text-gray-500">Holder</p>
                                        <p class="mt-1 font-black">
                                            {{ $ticket->holder_name ?? $booking->customer_name }}
                                        </p>
                                    </div>

                                    @if($ticket->checked_in_at)
                                        <div class="mt-4 rounded-xl bg-blue-50 p-4">
                                            <p class="text-sm font-bold text-blue-700">Checked In At</p>
                                            <p class="mt-1 font-black text-blue-900">
                                                {{ $ticket->checked_in_at->format('M d, Y h:i A') }}
                                            </p>
                                        </div>
                                    @endif

                                    @if($ticket->checkIns->count())
                                        <div class="mt-4 text-sm text-gray-500">
                                            Checked by:
                                            <span class="font-bold">
                                                {{ $ticket->checkIns->first()?->checkedInBy?->name ?? 'Support Staff' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <aside class="space-y-8">
                    <div class="rounded-3xl bg-white p-6 shadow">
                        <h3 class="text-xl font-black">Event Details</h3>

                        <div class="mt-5 space-y-4">
                            <div>
                                <p class="text-sm font-bold text-gray-500">Event</p>
                                <p class="mt-1 font-black">{{ $booking->event?->title }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-500">Category</p>
                                <p class="mt-1 font-black">{{ $booking->event?->category?->name ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-500">Date</p>
                                <p class="mt-1 font-black">
                                    {{ $booking->event?->event_date?->format('M d, Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-500">Venue</p>
                                <p class="mt-1 font-black">
                                    {{ $booking->event?->venue }} • {{ $booking->event?->city }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow">
                        <h3 class="text-xl font-black">Payment & Ticket</h3>

                        <div class="mt-5 space-y-4">
                            <div>
                                <p class="text-sm font-bold text-gray-500">Ticket Type</p>
                                <p class="mt-1 font-black">{{ $booking->ticketType?->name ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-500">Unit Price</p>
                                <p class="mt-1 font-black">
                                    LKR {{ number_format($booking->unit_price, 2) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-500">Payment Status</p>

                                @if($booking->payment_status === 'paid')
                                    <span class="mt-2 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                        Paid
                                    </span>
                                @elseif($booking->payment_status === 'manual_pending')
                                    <span class="mt-2 inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                        Manual Pending
                                    </span>
                                @else
                                    <span class="mt-2 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700">
                                        {{ str_replace('_', ' ', ucfirst($booking->payment_status)) }}
                                    </span>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-500">Booking Status</p>
                                <p class="mt-1 font-black">{{ ucfirst($booking->status) }}</p>
                            </div>
                        </div>
                    </div>

                    @if($booking->notes)
                        <div class="rounded-3xl bg-white p-6 shadow">
                            <h3 class="text-xl font-black">Notes</h3>
                            <p class="mt-3 leading-6 text-gray-600">
                                {{ $booking->notes }}
                            </p>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>