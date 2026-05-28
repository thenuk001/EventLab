<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Company Management
            </h2>

            <a href="{{ route('super.companies.create') }}"
               class="rounded-full bg-orange-500 px-5 py-2 text-sm font-bold text-white hover:bg-orange-400">
                Add Company
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 p-4 font-bold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-red-100 p-4 font-bold text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="GET" class="mb-6 grid gap-4 rounded-3xl bg-white p-5 shadow md:grid-cols-4">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search by name or email"
                       class="rounded-2xl border-gray-300">

                <select name="status" class="rounded-2xl border-gray-300">
                    <option value="">All statuses</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    <option value="blocked" @selected(request('status') === 'blocked')>Blocked</option>
                </select>

                <select name="approval_status" class="rounded-2xl border-gray-300">
                    <option value="">All approval statuses</option>
                    <option value="pending" @selected(request('approval_status') === 'pending')>Pending</option>
                    <option value="approved" @selected(request('approval_status') === 'approved')>Approved</option>
                    <option value="rejected" @selected(request('approval_status') === 'rejected')>Rejected</option>
                </select>

                <button class="rounded-2xl bg-orange-500 px-5 py-3 font-black text-white hover:bg-orange-400">
                    Filter
                </button>
            </form>

            <div class="overflow-hidden rounded-3xl bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4">Company</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Approval</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($companies as $company)
                            <tr class="border-b align-top">
                                <td class="px-6 py-4">
                                    <div class="font-black">{{ $company->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $company->contact_person ?? 'No contact person' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $company->email }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($company->status === 'active')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                            Active
                                        </span>
                                    @elseif($company->status === 'blocked')
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                            Blocked
                                        </span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if($company->approval_status === 'approved')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                            Approved
                                        </span>
                                    @elseif($company->approval_status === 'rejected')
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('super.companies.edit', $company) }}"
                                           class="rounded-full bg-slate-900 px-4 py-2 text-sm font-bold text-white hover:bg-slate-700">
                                            Edit
                                        </a>

                                        @if($company->approval_status !== 'approved')
                                            <form method="POST" action="{{ route('super.companies.approve', $company) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button class="rounded-full bg-green-500 px-4 py-2 text-sm font-bold text-white hover:bg-green-400">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif

                                        @if($company->status !== 'active')
                                            <form method="POST" action="{{ route('super.companies.activate', $company) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button class="rounded-full bg-green-500 px-4 py-2 text-sm font-bold text-white hover:bg-green-400">
                                                    Activate
                                                </button>
                                            </form>
                                        @endif

                                        @if($company->status !== 'inactive')
                                            <form method="POST" action="{{ route('super.companies.deactivate', $company) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button class="rounded-full bg-orange-500 px-4 py-2 text-sm font-bold text-white hover:bg-orange-400">
                                                    Deactivate
                                                </button>
                                            </form>
                                        @endif

                                        @if($company->status !== 'blocked')
                                            <form method="POST" action="{{ route('super.companies.block', $company) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button class="rounded-full bg-red-500 px-4 py-2 text-sm font-bold text-white hover:bg-red-400">
                                                    Block
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    No companies found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
</x-app-layout>