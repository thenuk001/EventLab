<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Company Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-blue-900 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">
                    {{ $company?->name ?? 'Company Dashboard' }}
                </h1>
                <p class="mt-3 text-slate-200">
                    Manage your events, ticket types, WhatsApp booking settings, enquiries, and QR check-ins.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Active Events</p>
                    <h3 class="mt-3 text-4xl font-black">0</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">WhatsApp Clicks</p>
                    <h3 class="mt-3 text-4xl font-black text-green-600">0</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Bookings</p>
                    <h3 class="mt-3 text-4xl font-black text-orange-500">0</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">QR Check-ins</p>
                    <h3 class="mt-3 text-4xl font-black text-purple-600">0</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>