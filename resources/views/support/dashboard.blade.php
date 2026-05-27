<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Support Dashboard</h2>
            <span class="rounded-full bg-orange-100 px-4 py-1 text-sm font-bold text-orange-700">Support Staff</span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">

            <!-- Header card -->
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-orange-800 to-green-700 p-8 text-white shadow-xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-black">Support Center</h1>
                        <p class="mt-3 text-slate-200">Handle customer enquiries, bookings, and QR check-ins.</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('support.enquiries.index') }}" class="rounded-full bg-white px-6 py-3 text-sm font-black text-slate-900 hover:bg-slate-100">View Enquiries</a>
                        <a href="{{ route('support.check-in.index') }}" class="rounded-full bg-green-500 px-6 py-3 text-sm font-black text-white hover:bg-green-400">QR Check-in</a>
                    </div>
                </div>
            </div>

            <!-- Stats cards -->
            <div class="grid gap-6 md:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">New Enquiries</p>
                    <h3 class="mt-3 text-4xl font-black text-orange-500">{{ $newEnquiries }}</h3>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">Contacted</p>
                    <h3 class="mt-3 text-4xl font-black text-blue-600">{{ $contactedEnquiries }}</h3>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">Confirmed Bookings</p>
                    <h3 class="mt-3 text-4xl font-black text-green-600">{{ $confirmedBookings }}</h3>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">QR Check-ins</p>
                    <h3 class="mt-3 text-4xl font-black text-purple-600">{{ $qrCheckIns }}</h3>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>