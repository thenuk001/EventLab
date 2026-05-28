<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Company
            </h2>

            <a href="{{ route('super.companies.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Back to Companies
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-red-100 p-4 font-bold text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">
                    {{ $company->name }}
                </h1>

                <p class="mt-3 text-slate-200">
                    Update company profile, activation status, and approval status separately.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('super.companies.update', $company) }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf
                @method('PUT')

                <div class="grid gap-6">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Company Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $company->name) }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Contact Person
                        </label>

                        <input type="text"
                               name="contact_person"
                               value="{{ old('contact_person', $company->contact_person) }}"
                               class="w-full rounded-2xl border-gray-300"
                               placeholder="Example: Demo Manager">

                        @error('contact_person')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $company->email) }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            WhatsApp Number
                        </label>

                        <input type="text"
                               name="whatsapp_number"
                               value="{{ old('whatsapp_number', $company->whatsapp_number) }}"
                               class="w-full rounded-2xl border-gray-300"
                               placeholder="Example: 94771234567">

                        <p class="mt-2 text-sm text-gray-500">
                            This is company contact information only. Public booking still goes to EventLab WhatsApp number.
                        </p>

                        @error('whatsapp_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Operational Status
                            </label>

                            <select name="status"
                                    class="w-full rounded-2xl border-gray-300"
                                    required>
                                <option value="active" @selected(old('status', $company->status) === 'active')>
                                    Active
                                </option>

                                <option value="inactive" @selected(old('status', $company->status) === 'inactive')>
                                    Inactive
                                </option>

                                <option value="blocked" @selected(old('status', $company->status) === 'blocked')>
                                    Blocked
                                </option>
                            </select>

                            <p class="mt-2 text-sm text-gray-500">
                                Active companies can access their dashboard. Inactive/blocked companies cannot.
                            </p>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Approval Status
                            </label>

                            <select name="approval_status"
                                    class="w-full rounded-2xl border-gray-300"
                                    required>
                                <option value="pending" @selected(old('approval_status', $company->approval_status) === 'pending')>
                                    Pending
                                </option>

                                <option value="approved" @selected(old('approval_status', $company->approval_status) === 'approved')>
                                    Approved
                                </option>

                                <option value="rejected" @selected(old('approval_status', $company->approval_status) === 'rejected')>
                                    Rejected
                                </option>
                            </select>

                            <p class="mt-2 text-sm text-gray-500">
                                Approved companies can publish/manage events after they are active.
                            </p>

                            @error('approval_status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="rounded-2xl bg-blue-50 p-5">
                        <p class="text-sm font-black text-blue-800">
                            Access Rule
                        </p>

                        <p class="mt-2 text-sm leading-6 text-blue-700">
                            Company admins can access the company dashboard only when
                            <span class="font-black">Operational Status = Active</span>
                            and
                            <span class="font-black">Approval Status = Approved</span>.
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('super.companies.index') }}"
                           class="font-bold text-gray-500">
                            Cancel
                        </a>

                        <button class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
                            Update Company
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>