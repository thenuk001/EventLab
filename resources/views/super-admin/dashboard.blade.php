<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Super Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white">
                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-4xl font-black">EventLab Super Admin</h1>
                        <p class="mt-3 text-slate-200">
                            Manage companies, platform users, approvals, categories, and reports.
                        </p>
                    </div>

                    <a href="{{ route('super.events.index') }}"
                       class="rounded-full bg-white px-6 py-3 text-sm font-black text-slate-900 hover:bg-slate-100">
                        Event Approvals
                    </a>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Total Companies</p>
                    <h3 class="mt-3 text-4xl font-black">{{ $totalCompanies }}</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Approved Companies</p>
                    <h3 class="mt-3 text-4xl font-black text-green-600">{{ $approvedCompanies }}</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Pending Companies</p>
                    <h3 class="mt-3 text-4xl font-black text-orange-500">{{ $pendingCompanies }}</h3>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow">
                    <p class="text-sm font-bold text-gray-500">Total Users</p>
                    <h3 class="mt-3 text-4xl font-black text-purple-600">{{ $totalUsers }}</h3>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <a href="{{ route('super.events.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Event Approvals</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Approve, reject, and feature company-submitted events.
                    </p>
                </a>

                <a href="#"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Company Management</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage event organizer companies and approvals.
                    </p>
                </a>

                <a href="#"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg">
                    <h3 class="text-xl font-black">Platform Reports</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Track public events, bookings, and WhatsApp activity.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>