<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Create Company
            </h2>

            <a href="{{ route('super.companies.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200">
                Back to Companies
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-red-100 p-4 font-bold text-red-700">
                    <p class="mb-2">Please fix the following errors:</p>

                    <ul class="list-inside list-disc text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">
                    Add New Company
                </h1>

                <p class="mt-3 text-slate-200">
                    Create a company profile. New companies are created as inactive and pending until approved.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('super.companies.store') }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf

                <div class="grid gap-6">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Company Name
                        </label>

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
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Email
                        </label>

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
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Contact Person
                        </label>

                        <input type="text"
                               name="contact_person"
                               value="{{ old('contact_person') }}"
                               class="w-full rounded-2xl border-gray-300"
                               placeholder="Example: Demo Manager">

                        @error('contact_person')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            WhatsApp Number
                        </label>

                        <input type="text"
                               name="whatsapp_number"
                               value="{{ old('whatsapp_number') }}"
                               class="w-full rounded-2xl border-gray-300"
                               placeholder="Example: 94771234567">

                        <p class="mt-2 text-sm text-gray-500">
                            This is company contact information only. Public booking buttons still redirect to EventLab WhatsApp.
                        </p>

                        @error('whatsapp_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-5">
                        <p class="text-sm font-black text-orange-800">
                            Default Status After Creation
                        </p>

                        <p class="mt-2 text-sm leading-6 text-orange-700">
                            New companies will be created with
                            <span class="font-black">Operational Status: Inactive</span>
                            and
                            <span class="font-black">Approval Status: Pending</span>.
                            After creation, you will be redirected to the company list where you can approve and activate the company.
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('super.companies.index') }}"
                           class="rounded-full bg-gray-100 px-6 py-3 text-sm font-black text-gray-700 hover:bg-gray-200">
                            Cancel
                        </a>

                        <button type="submit"
                                class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
                            Create Company
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>