<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Company Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-blue-900 to-green-600 p-8 text-white">
                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-4xl font-black">
                            {{ $company?->name ?? 'Company Dashboard' }}
                        </h1>

                        <p class="mt-3 text-slate-200">
                            Manage your events, ticket types, WhatsApp booking settings, enquiries, bookings, and QR check-ins.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('company.events.index') }}"
                           class="rounded-full bg-white px-6 py-3 text-sm font-black text-slate-900 hover:bg-slate-100">
                            Manage Events
                        </a>

                        <a href="{{ route('company.events.create') }}"
                           class="rounded-full bg-orange-500 px-6 py-3 text-sm font-black text-white hover:bg-orange-400">
                            Create Event
                        </a>

                        <a href="{{ route('company.enquiries.index') }}"
                           class="rounded-full bg-green-500 px-6 py-3 text-sm font-black text-white hover:bg-green-400">
                            View Enquiries
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Active Events</p>
                    <h3 class="mt-3 text-4xl font-black">{{ $activeEvents }}</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">WhatsApp Clicks</p>
                    <h3 class="mt-3 text-4xl font-black text-green-600">{{ $whatsappClicks }}</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Bookings</p>
                    <h3 class="mt-3 text-4xl font-black text-orange-500">{{ $bookings }}</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">QR Check-ins</p>
                    <h3 class="mt-3 text-4xl font-black text-purple-600">{{ $qrCheckIns }}</h3>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-4">
                <a href="{{ route('company.events.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Event Management</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        View, create, and edit your company events.
                    </p>
                </a>

                <a href="{{ route('company.events.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Ticket Types</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage Standard, VIP, Zone, Balcony, and other ticket types from each event.
                    </p>
                </a>

                <a href="{{ route('company.events.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">WhatsApp Settings</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Set WhatsApp button labels and message templates from each event.
                    </p>
                </a>

                <a href="{{ route('company.enquiries.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">WhatsApp Enquiries</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        View WhatsApp clicks and booking interest from public users.
                    </p>
                </a>

                <a href="{{ route('company.bookings.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Bookings</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        View confirmed bookings and generated QR ticket codes.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>