<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Super Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white">
                <h1 class="text-4xl font-black">EventLab Super Admin</h1>
                <p class="mt-3 text-slate-200">
                    Manage companies, platform users, approvals, categories, and reports.
                </p>
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
        </div>
    </div>
</x-app-layout>