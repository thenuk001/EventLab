<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Create Event for Company
            </h2>

            <a href="{{ route('super.events.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200">
                Back to Events
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4">
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
                    Create Event on Behalf of Company
                </h1>

                <p class="mt-3 text-slate-200">
                    Use this when a company needs Super Admin support to publish or prepare an event.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('super.events.store') }}"
                  class="rounded-3xl bg-white p-8 shadow">
                @csrf

                <div class="grid gap-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Company
                            </label>

                            <select name="company_id"
                                    class="w-full rounded-2xl border-gray-300"
                                    required>
                                <option value="">Select company</option>

                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('company_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Category
                            </label>

                            <select name="category_id"
                                    class="w-full rounded-2xl border-gray-300"
                                    required>
                                <option value="">Select category</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Event Title
                        </label>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="w-full rounded-2xl border-gray-300"
                               required>

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="6"
                                  class="w-full rounded-2xl border-gray-300"
                                  required>{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-3">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Event Date
                            </label>

                            <input type="date"
                                   name="event_date"
                                   value="{{ old('event_date') }}"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>

                            @error('event_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Start Time
                            </label>

                            <input type="time"
                                   name="start_time"
                                   value="{{ old('start_time') }}"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>

                            @error('start_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                End Time
                            </label>

                            <input type="time"
                                   name="end_time"
                                   value="{{ old('end_time') }}"
                                   class="w-full rounded-2xl border-gray-300">

                            @error('end_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Venue
                            </label>

                            <input type="text"
                                   name="venue"
                                   value="{{ old('venue') }}"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>

                            @error('venue')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                City
                            </label>

                            <input type="text"
                                   name="city"
                                   value="{{ old('city') }}"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>

                            @error('city')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Google Map URL
                        </label>

                        <input type="url"
                               name="map_url"
                               value="{{ old('map_url') }}"
                               class="w-full rounded-2xl border-gray-300"
                               placeholder="https://maps.google.com/...">

                        @error('map_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Event Status
                            </label>

                            <select name="status"
                                    class="w-full rounded-2xl border-gray-300"
                                    required>
                                <option value="published" @selected(old('status', 'published') === 'published')>
                                    Published
                                </option>

                                <option value="draft" @selected(old('status') === 'draft')>
                                    Draft
                                </option>
                            </select>

                            <p class="mt-2 text-sm text-gray-500">
                                Published means ready for public view after approval.
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
                                <option value="approved" @selected(old('approval_status', 'approved') === 'approved')>
                                    Approved
                                </option>

                                <option value="pending" @selected(old('approval_status') === 'pending')>
                                    Pending Review
                                </option>
                            </select>

                            <p class="mt-2 text-sm text-gray-500">
                                Super Admin-created events can be approved immediately.
                            </p>

                            @error('approval_status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl bg-purple-50 p-5">
                        <input type="checkbox"
                               name="is_featured"
                               value="1"
                               @checked(old('is_featured'))
                               class="rounded border-gray-300">

                        <div>
                            <p class="text-sm font-black text-purple-800">
                                Feature this event
                            </p>

                            <p class="text-sm text-purple-700">
                                Featured events can be highlighted on the public landing page.
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Approval Comment
                        </label>

                        <textarea name="approval_comment"
                                  rows="4"
                                  class="w-full rounded-2xl border-gray-300"
                                  placeholder="Example: Created and approved by Super Admin on behalf of company.">{{ old('approval_comment') }}</textarea>

                        @error('approval_comment')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('super.events.index') }}"
                           class="rounded-full bg-gray-100 px-6 py-3 text-sm font-black text-gray-700 hover:bg-gray-200">
                            Cancel
                        </a>

                        <button class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
                            Create Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>