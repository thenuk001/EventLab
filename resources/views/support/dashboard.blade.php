<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Support Dashboard
            </h2>

            <span class="rounded-full bg-orange-100 px-4 py-1 text-sm font-bold text-orange-700">
                Support Staff
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-orange-800 to-green-700 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">Support Center</h1>
                <p class="mt-3 text-slate-200">
                    Handle customer enquiries, WhatsApp follow-ups, and QR check-ins.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <a href="{{ route('support.enquiries.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Customer Enquiries</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        View WhatsApp booking requests and update follow-up status.
                    </p>
                </a>

                <a href="#"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">QR Check-in</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Validate tickets at event entrance.
                    </p>
                </a>

                <a href="#"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Booking Status</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Update pending, confirmed, and cancelled bookings.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>