<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Ticket Type
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-6 rounded-3xl bg-gradient-to-r from-slate-900 via-blue-900 to-green-600 p-8 text-white">
                <h1 class="text-3xl font-black">{{ $ticketType->event->title }}</h1>
                <p class="mt-2 text-slate-200">Update ticket type details.</p>
            </div>

            <form method="POST"
                  action="{{ route('company.tickets.update', $ticketType) }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf
                @method('PUT')

                @include('company.tickets.partials.form', [
                    'ticketType' => $ticketType,
                    'buttonText' => 'Update Ticket Type',
                    'cancelUrl' => route('company.events.tickets.index', $ticketType->event),
                ])
            </form>
        </div>
    </div>
</x-app-layout>