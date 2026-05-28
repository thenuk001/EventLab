<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit User
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
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
                <h1 class="text-4xl font-black">{{ $user->name }}</h1>
                <p class="mt-3 text-slate-200">
                    Edit user details, role, company assignment, and reset password.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('super.users.update', $user) }}"
                  class="mb-8 rounded-3xl bg-white p-8 shadow">
                @csrf
                @method('PUT')

                <div class="grid gap-6">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Role</label>
                        <select name="role" class="w-full rounded-2xl border-gray-300" required>
                            <option value="super_admin" @selected(old('role', $user->roles->first()?->name) === 'super_admin')>Super Admin</option>
                            <option value="company_admin" @selected(old('role', $user->roles->first()?->name) === 'company_admin')>Company Admin</option>
                            <option value="support_staff" @selected(old('role', $user->roles->first()?->name) === 'support_staff')>Support Staff</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Company</label>
                        <select name="company_id" class="w-full rounded-2xl border-gray-300">
                            <option value="">No company / Not required</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" @selected(old('company_id', $user->company_id) == $company->id)>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-sm text-gray-500">
                            Required only for Company Admin users.
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('super.users.index') }}"
                           class="font-bold text-gray-500">
                            Cancel
                        </a>

                        <button class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
                            Update User
                        </button>
                    </div>
                </div>
            </form>

            <form method="POST"
                  action="{{ route('super.users.reset-password', $user) }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf
                @method('PATCH')

                <h2 class="text-2xl font-black">Reset Password</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Set a new password for this user.
                </p>

                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">New Password</label>
                        <input type="password"
                               name="password"
                               class="w-full rounded-2xl border-gray-300"
                               required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Confirm New Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="w-full rounded-2xl border-gray-300"
                               required>
                    </div>
                </div>

                <button class="mt-6 rounded-full bg-slate-900 px-8 py-3 font-black text-white hover:bg-slate-700">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</x-app-layout>