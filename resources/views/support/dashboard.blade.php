<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Support Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-orange-800 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">EventLab Support Center</h1>
                <p class="mt-3 text-slate-200">
                    Handle customer enquiries, WhatsApp follow-ups, booking support, and QR check-ins.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-3xl bg-white p-6 shadow">
                    <h3 class="text-xl font-black">Customer Enquiries</h3>
                    <p class="mt-2 text-sm text-gray-500">View and handle WhatsApp booking requests.</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <h3 class="text-xl font-black">QR Check-In</h3>
                    <p class="mt-2 text-sm text-gray-500">Validate tickets at event entrance.</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <h3 class="text-xl font-black">Booking Status</h3>
                    <p class="mt-2 text-sm text-gray-500">Update confirmed, pending, and cancelled bookings.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>