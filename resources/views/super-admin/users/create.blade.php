<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Create User
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">Add Platform User</h1>
                <p class="mt-3 text-slate-200">
                    Create Company Admins and Support Staff for EventLab.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('super.users.store') }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf

                <div class="grid gap-6">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">Role</label>
                        <select name="role" class="w-full rounded-2xl border-gray-300" required>
                            <option value="">Select role</option>
                            <option value="company_admin" @selected(old('role') === 'company_admin')>Company Admin</option>
                            <option value="support_staff" @selected(old('role') === 'support_staff')>Support Staff</option>
                        </select>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Company
                        </label>
                        <select name="company_id" class="w-full rounded-2xl border-gray-300">
                            <option value="">No company / Not required</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-sm text-gray-500">
                            Required only for Company Admin users.
                        </p>
                        @error('company_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">Password</label>
                            <input type="password"
                                   name="password"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('super.users.index') }}"
                           class="font-bold text-gray-500">
                            Cancel
                        </a>

                        <button class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
                            Create User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>