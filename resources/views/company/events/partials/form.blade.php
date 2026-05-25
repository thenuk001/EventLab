<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Event Title</label>
        <input type="text"
               name="title"
               value="{{ old('title', $event?->title) }}"
               class="w-full rounded-2xl border-gray-300"
               required>

        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Category</label>
        <select name="category_id" class="w-full rounded-2xl border-gray-300" required>
            <option value="">Select category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $event?->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('category_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Description</label>
        <textarea name="description"
                  rows="5"
                  class="w-full rounded-2xl border-gray-300">{{ old('description', $event?->description) }}</textarea>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">Event Date</label>
            <input type="date"
                   name="event_date"
                   value="{{ old('event_date', $event?->event_date?->format('Y-m-d')) }}"
                   class="w-full rounded-2xl border-gray-300"
                   required>
        </div>

        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">Start Time</label>
            <input type="time"
                   name="start_time"
                   value="{{ old('start_time', $event?->start_time) }}"
                   class="w-full rounded-2xl border-gray-300">
        </div>

        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">End Time</label>
            <input type="time"
                   name="end_time"
                   value="{{ old('end_time', $event?->end_time) }}"
                   class="w-full rounded-2xl border-gray-300">
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">Venue</label>
            <input type="text"
                   name="venue"
                   value="{{ old('venue', $event?->venue) }}"
                   class="w-full rounded-2xl border-gray-300">
        </div>

        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">City</label>
            <input type="text"
                   name="city"
                   value="{{ old('city', $event?->city) }}"
                   class="w-full rounded-2xl border-gray-300">
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Google Map URL</label>
        <input type="text"
               name="map_url"
               value="{{ old('map_url', $event?->map_url) }}"
               class="w-full rounded-2xl border-gray-300">
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Status</label>
        <select name="status" class="w-full rounded-2xl border-gray-300" required>
            <option value="draft" @selected(old('status', $event?->status ?? 'draft') === 'draft')>
                Draft
            </option>
            <option value="published" @selected(old('status', $event?->status) === 'published')>
                Published
            </option>
        </select>

        <p class="mt-2 text-sm text-gray-500">
            Published events still need Super Admin approval before showing publicly.
        </p>
    </div>

    <div class="flex items-center justify-between pt-4">
        <a href="{{ route('company.events.index') }}" class="font-bold text-gray-500">
            Cancel
        </a>

        <button class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
            {{ $buttonText }}
        </button>
    </div>
</div>