<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                QR / Manual Check-in
            </h2>

            <a href="{{ route('support.dashboard') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 p-4 font-bold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-2xl bg-red-100 p-4 font-bold text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-orange-800 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">Ticket Check-in</h1>
                <p class="mt-3 text-slate-200">
                    Enter the QR ticket code manually to validate and check in a customer.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('support.check-in.search') }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    QR Ticket Code
                </label>

                <input type="text"
                       name="ticket_code"
                       value="{{ old('ticket_code') }}"
                       placeholder="Example: QR-ABC123XYZ"
                       class="w-full rounded-2xl border-gray-300 text-lg font-bold uppercase"
                       required>

                @error('ticket_code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <button class="mt-6 w-full rounded-full bg-orange-500 px-6 py-4 text-lg font-black text-white hover:bg-orange-400">
                    Search Ticket
                </button>
            </form>
        </div>
    </div>
</x-app-layout>