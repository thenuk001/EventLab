<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                User Management
            </h2>

            <a href="{{ route('super.users.create') }}"
               class="rounded-full bg-orange-500 px-5 py-2 text-sm font-bold text-white hover:bg-orange-400">
                Add User
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

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">Platform Users</h1>
                <p class="mt-3 text-slate-200">
                    Create, edit, activate, block, and reset passwords for Company Admins and Support Staff.
                </p>
            </div>

            <form method="GET" class="mb-6 grid gap-4 rounded-3xl bg-white p-5 shadow md:grid-cols-4">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search name or email..."
                       class="rounded-2xl border-gray-300">

                <select name="role" class="rounded-2xl border-gray-300">
                    <option value="">All roles</option>
                    <option value="company_admin" @selected(request('role') === 'company_admin')>Company Admin</option>
                    <option value="support_staff" @selected(request('role') === 'support_staff')>Support Staff</option>
                    <option value="super_admin" @selected(request('role') === 'super_admin')>Super Admin</option>
                </select>

                <select name="status" class="rounded-2xl border-gray-300">
                    <option value="">All statuses</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    <option value="blocked" @selected(request('status') === 'blocked')>Blocked</option>
                </select>

                <button class="rounded-2xl bg-orange-500 px-5 py-3 font-black text-white hover:bg-orange-400">
                    Filter
                </button>
            </form>

            <div class="overflow-hidden rounded-3xl bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Company</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b align-top">
                                <td class="px-6 py-4">
                                    <div class="font-black">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    @foreach($user->roles as $role)
                                        <span class="mb-1 inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700">
                                            {{ str_replace('_', ' ', ucfirst($role->name)) }}
                                        </span>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->company?->name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($user->status === 'active')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                            Active
                                        </span>
                                    @elseif($user->status === 'blocked')
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
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('super.users.edit', $user) }}"
                                           class="rounded-full bg-slate-900 px-4 py-2 text-center text-sm font-bold text-white hover:bg-slate-700">
                                            Edit
                                        </a>

                                        @if($user->status !== 'active')
                                            <form method="POST" action="{{ route('super.users.activate', $user) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-full bg-green-500 px-4 py-2 text-sm font-bold text-white hover:bg-green-400">
                                                    Activate
                                                </button>
                                            </form>
                                        @endif

                                        @if($user->status !== 'inactive' && $user->id !== auth()->id())
                                            <form method="POST" action="{{ route('super.users.deactivate', $user) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-full bg-orange-500 px-4 py-2 text-sm font-bold text-white hover:bg-orange-400">
                                                    Deactivate
                                                </button>
                                            </form>
                                        @endif

                                        @if($user->status !== 'blocked' && $user->id !== auth()->id())
                                            <form method="POST" action="{{ route('super.users.block', $user) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-full bg-red-500 px-4 py-2 text-sm font-bold text-white hover:bg-red-400">
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
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>