<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Bookings
            </h2>

            <a href="{{ route('company.enquiries.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Back to Enquiries
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 p-4 font-bold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">Confirmed Bookings</h1>
                <p class="mt-3 text-slate-200">
                    View confirmed bookings and generated QR ticket codes.
                </p>
            </div>

            <div class="overflow-hidden rounded-3xl bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4">Booking</th>
                            <th class="px-6 py-4">Event</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Ticket</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4">QR Tickets</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($bookings as $booking)
                            <tr class="border-b align-top">
                                <td class="px-6 py-4">
                                    <div class="font-black">{{ $booking->booking_code }}</div>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ ucfirst($booking->status) }} /
                                        {{ str_replace('_', ' ', ucfirst($booking->payment_status)) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold">{{ $booking->event?->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->event?->event_code }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold">{{ $booking->customer_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->ticketType?->name }}
                                    <div class="text-sm text-gray-500">
                                        Qty: {{ $booking->quantity }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-black text-orange-600">
                                        LKR {{ number_format($booking->total_amount, 2) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @foreach($booking->qrTickets as $ticket)
                                            <div class="rounded-xl bg-gray-100 px-3 py-2 text-xs font-bold text-gray-700">
                                                {{ $ticket->ticket_code }}
                                                <span class="ml-2 text-gray-400">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    No bookings yet. Create bookings from enquiries.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout>