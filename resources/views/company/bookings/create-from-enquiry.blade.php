<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Create Booking from Enquiry
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">{{ $enquiry->event->title }}</h1>
                <p class="mt-3 text-slate-200">
                    Convert this WhatsApp enquiry into a confirmed booking and generate QR tickets.
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <form method="POST"
                      action="{{ route('company.enquiries.booking.store', $enquiry) }}"
                      class="rounded-3xl bg-white p-8 shadow lg:col-span-2">
                    @csrf

                    <div class="grid gap-6">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Ticket Type
                            </label>

                            <select name="ticket_type_id" class="w-full rounded-2xl border-gray-300" required>
                                <option value="">Select ticket type</option>
                                @foreach($enquiry->event->ticketTypes as $ticket)
                                    <option value="{{ $ticket->id }}" @selected(old('ticket_type_id', $enquiry->ticket_type_id) == $ticket->id)>
                                        {{ $ticket->name }} - LKR {{ number_format($ticket->price, 2) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('ticket_type_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-gray-700">
                                    Customer Name
                                </label>

                                <input type="text"
                                       name="customer_name"
                                       value="{{ old('customer_name', $enquiry->customer_name) }}"
                                       class="w-full rounded-2xl border-gray-300"
                                       required>

                                @error('customer_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-gray-700">
                                    Customer Phone
                                </label>

                                <input type="text"
                                       name="customer_phone"
                                       value="{{ old('customer_phone', $enquiry->customer_phone) }}"
                                       class="w-full rounded-2xl border-gray-300">

                                @error('customer_phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-gray-700">
                                    Customer Email
                                </label>

                                <input type="email"
                                       name="customer_email"
                                       value="{{ old('customer_email') }}"
                                       class="w-full rounded-2xl border-gray-300">

                                @error('customer_email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-gray-700">
                                    Quantity
                                </label>

                                <input type="number"
                                       name="quantity"
                                       value="{{ old('quantity', $enquiry->quantity ?? 1) }}"
                                       min="1"
                                       max="20"
                                       class="w-full rounded-2xl border-gray-300"
                                       required>

                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Payment Status
                            </label>

                            <select name="payment_status" class="w-full rounded-2xl border-gray-300" required>
                                <option value="manual_pending" @selected(old('payment_status') === 'manual_pending')>
                                    Manual Pending
                                </option>
                                <option value="paid" @selected(old('payment_status') === 'paid')>
                                    Paid
                                </option>
                                <option value="unpaid" @selected(old('payment_status') === 'unpaid')>
                                    Unpaid
                                </option>
                                <option value="refunded" @selected(old('payment_status') === 'refunded')>
                                    Refunded
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Notes
                            </label>

                            <textarea name="notes"
                                      rows="4"
                                      class="w-full rounded-2xl border-gray-300">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('company.enquiries.index') }}" class="font-bold text-gray-500">
                                Cancel
                            </a>

                            <button class="rounded-full bg-green-500 px-8 py-3 font-black text-white hover:bg-green-400">
                                Create Booking & QR Tickets
                            </button>
                        </div>
                    </div>
                </form>

                <aside class="rounded-3xl bg-slate-900 p-6 text-white shadow">
                    <p class="text-sm font-black uppercase tracking-widest text-green-300">
                        Enquiry Info
                    </p>

                    <h3 class="mt-2 text-2xl font-black">
                        {{ $enquiry->event->event_code }}
                    </h3>

                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-sm text-slate-400">Clicked At</p>
                            <p class="mt-1 font-bold">
                                {{ $enquiry->clicked_at?->format('M d, Y h:i A') ?? $enquiry->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-sm text-slate-400">Status</p>
                            <p class="mt-1 font-bold">{{ ucfirst($enquiry->status) }}</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>