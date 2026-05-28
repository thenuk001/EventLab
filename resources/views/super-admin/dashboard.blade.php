<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Super Admin Dashboard</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">

            <!-- Header card -->
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">EventLab Super Admin</h1>
                <p class="mt-3 text-slate-200">Manage companies, platform users, approvals, categories, and reports.</p>
            </div>

            <!-- Stats cards -->
            <div class="grid gap-6 md:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">Total Companies</p>
                    <h3 class="mt-3 text-4xl font-black">{{ $totalCompanies }}</h3>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">Approved Companies</p>
                    <h3 class="mt-3 text-4xl font-black text-green-600">{{ $approvedCompanies }}</h3>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">Pending Companies</p>
                    <h3 class="mt-3 text-4xl font-black text-orange-500">{{ $pendingCompanies }}</h3>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <p class="text-sm font-bold text-gray-500">Total Users</p>
                    <h3 class="mt-3 text-4xl font-black text-purple-600">{{ $totalUsers }}</h3>
                </div>
            </div>

            <!-- Quick access cards -->
            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('super.events.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-black">Event Approvals</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Review, approve, reject, and feature company events.
                    </p>
                </a>

                <a href="{{ route('super.users.index') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-black">User Management</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Create, edit, activate, block, and reset passwords for Company Admins and Support Staff.
                    </p>
                </a>

                <a href="{{ route('super.dashboard') }}"
                   class="rounded-3xl bg-white p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-black">Platform Reports</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        View system analytics, bookings, and platform activity reports.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>