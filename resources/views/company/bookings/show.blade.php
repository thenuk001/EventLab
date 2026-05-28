<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                    EventLab Booking Center
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    Booking Details
                </h2>
            </div>

            <a href="{{ route('company.bookings.index') }}"
               class="rounded-full bg-slate-100 px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-200">
                Back to Bookings
            </a>
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
                            Booking Code: {{ $booking->booking_code }}
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            {{ $booking->customer_name }}
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Booking for
                            <span class="font-black text-white">{{ $booking->event?->title ?? 'Event' }}</span>
                            with generated QR tickets ready for support check-in validation.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('company.bookings.index') }}"
                               class="rounded-full bg-white px-7 py-3 text-center text-sm font-black text-slate-950 hover:bg-slate-100">
                                Back to Bookings
                            </a>

                            <a href="{{ route('company.enquiries.index') }}"
                               class="rounded-full bg-green-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-green-400">
                                View Enquiries
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-300">
                            Booking Summary
                        </p>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs font-bold text-slate-300">Quantity</p>
                                <p class="mt-1 text-2xl font-black">{{ $booking->quantity }}</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs font-bold text-slate-300">Tickets</p>
                                <p class="mt-1 text-2xl font-black">{{ $booking->qrTickets->count() }}</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4 col-span-2">
                                <p class="text-xs font-bold text-slate-300">Total Amount</p>
                                <p class="mt-1 text-2xl font-black">
                                    LKR {{ number_format($booking->total_amount, 2) }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-black text-green-200">
                                {{ ucfirst($booking->status) }}
                            </span>

                            <span class="rounded-full bg-orange-500/20 px-3 py-1 text-xs font-black text-orange-200">
                                {{ ucfirst(str_replace('_', ' ', $booking->payment_status)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="grid gap-8 lg:grid-cols-3">
                <!-- Booking Information -->
                <div class="lg:col-span-1">
                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-500">
                                    Customer Info
                                </p>

                                <h3 class="mt-2 text-2xl font-black text-slate-950">
                                    Booking Information
                                </h3>
                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-3xl">
                                🧾
                            </div>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                    Customer Name
                                </p>
                                <p class="mt-1 font-black text-slate-900">
                                    {{ $booking->customer_name }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                    Phone
                                </p>
                                <p class="mt-1 font-black text-slate-900">
                                    {{ $booking->customer_phone ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                    Email
                                </p>
                                <p class="mt-1 font-black text-slate-900">
                                    {{ $booking->customer_email ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                    Event
                                </p>
                                <p class="mt-1 font-black text-slate-900">
                                    {{ $booking->event?->title ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                    Ticket Type
                                </p>
                                <p class="mt-1 font-black text-slate-900">
                                    {{ $booking->ticketType?->name ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                    Notes
                                </p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    {{ $booking->notes ?? 'No notes added.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Tickets -->
                <div class="lg:col-span-2">
                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <p class="text-sm font-black uppercase tracking-[0.2em] text-green-500">
                                    QR Tickets
                                </p>

                                <h3 class="mt-2 text-2xl font-black text-slate-950">
                                    Generated Ticket QR Codes
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Each ticket has a unique QR code. Support staff can scan these codes at the event entrance.
                                </p>
                            </div>

                            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-black text-green-700">
                                {{ $booking->qrTickets->count() }} Ticket(s)
                            </span>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            @forelse($booking->qrTickets as $ticket)
                                <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-widest text-slate-400">
                                                Ticket Holder
                                            </p>

                                            <h4 class="mt-1 text-xl font-black text-slate-950">
                                                {{ $ticket->holder_name }}
                                            </h4>

                                            <p class="mt-2 text-sm font-bold text-slate-500">
                                                {{ $ticket->ticket_code }}
                                            </p>
                                        </div>

                                        @if($ticket->checked_in_at)
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-black text-green-700">
                                                Checked In
                                            </span>
                                        @else
                                            <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-black text-orange-700">
                                                Not Used
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-5 flex justify-center rounded-2xl bg-white p-5 shadow-sm">
                                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(190)->generate($ticket->ticket_code) !!}
                                    </div>

                                    <div class="mt-5 rounded-2xl bg-white p-4">
                                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                            Status
                                        </p>

                                        @if($ticket->checked_in_at)
                                            <p class="mt-2 text-sm font-black text-green-600">
                                                Checked in at {{ $ticket->checked_in_at->format('M d, Y h:i A') }}
                                            </p>

                                            @if($ticket->checkedInBy)
                                                <p class="mt-1 text-xs text-slate-500">
                                                    By {{ $ticket->checkedInBy->name }}
                                                </p>
                                            @endif
                                        @else
                                            <p class="mt-2 text-sm font-black text-orange-500">
                                                Ready for QR scan validation
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-3xl bg-slate-50 p-10 text-center md:col-span-2">
                                    <div class="text-5xl">🎟️</div>
                                    <h3 class="mt-4 text-xl font-black text-slate-900">
                                        No QR tickets found
                                    </h3>
                                    <p class="mt-2 text-sm text-slate-500">
                                        QR tickets will appear here after booking creation.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>