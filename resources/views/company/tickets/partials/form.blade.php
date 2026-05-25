<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Ticket Name</label>
        <input type="text"
               name="name"
               value="{{ old('name', $ticketType?->name) }}"
               placeholder="Standard, VIP, Balcony, Zone..."
               class="w-full rounded-2xl border-gray-300"
               required>

        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">Price</label>
            <input type="number"
                   step="0.01"
                   name="price"
                   value="{{ old('price', $ticketType?->price) }}"
                   class="w-full rounded-2xl border-gray-300"
                   required>

            @error('price')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">Quantity</label>
            <input type="number"
                   name="quantity"
                   value="{{ old('quantity', $ticketType?->quantity ?? 0) }}"
                   class="w-full rounded-2xl border-gray-300"
                   required>

            @error('quantity')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-bold text-gray-700">Sold Count</label>
            <input type="number"
                   name="sold_count"
                   value="{{ old('sold_count', $ticketType?->sold_count ?? 0) }}"
                   class="w-full rounded-2xl border-gray-300">

            @error('sold_count')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Availability Status</label>
        <select name="availability_status" class="w-full rounded-2xl border-gray-300" required>
            <option value="available" @selected(old('availability_status', $ticketType?->availability_status ?? 'available') === 'available')>
                Available
            </option>
            <option value="few_left" @selected(old('availability_status', $ticketType?->availability_status) === 'few_left')>
                Few Left
            </option>
            <option value="sold_out" @selected(old('availability_status', $ticketType?->availability_status) === 'sold_out')>
                Sold Out
            </option>
            <option value="coming_soon" @selected(old('availability_status', $ticketType?->availability_status) === 'coming_soon')>
                Coming Soon
            </option>
        </select>
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-gray-700">Benefits / Description</label>
        <textarea name="benefits"
                  rows="4"
                  placeholder="General entry, premium seating, priority entry..."
                  class="w-full rounded-2xl border-gray-300">{{ old('benefits', $ticketType?->benefits) }}</textarea>
    </div>

    <div class="flex items-center justify-between pt-4">
        <a href="{{ $cancelUrl }}" class="font-bold text-gray-500">
            Cancel
        </a>

        <button class="rounded-full bg-orange-500 px-8 py-3 font-black text-white hover:bg-orange-400">
            {{ $buttonText }}
        </button>
    </div>
</div>