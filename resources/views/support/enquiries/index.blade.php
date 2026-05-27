<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Support Enquiries
            </h2>

            <a href="{{ route('support.dashboard') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Back to Dashboard
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

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-orange-800 to-green-600 p-8 text-white">
                <h1 class="text-4xl font-black">Customer Enquiry Support</h1>
                <p class="mt-3 text-slate-200">
                    Track WhatsApp booking clicks, follow up with customers, and update enquiry status.
                </p>
            </div>

            <form method="GET" class="mb-6 grid gap-4 rounded-3xl bg-white p-5 shadow md:grid-cols-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search event, code, company..."
                       class="rounded-2xl border-gray-300">

                <select name="status" class="rounded-2xl border-gray-300">
                    <option value="">All statuses</option>
                    <option value="new" @selected(request('status') === 'new')>New</option>
                    <option value="contacted" @selected(request('status') === 'contacted')>Contacted</option>
                    <option value="confirmed" @selected(request('status') === 'confirmed')>Confirmed</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                </select>

                <button class="rounded-2xl bg-orange-500 px-5 py-3 font-black text-white hover:bg-orange-400">
                    Filter
                </button>
            </form>

            <div class="overflow-hidden rounded-3xl bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4">Event</th>
                            <th class="px-6 py-4">Company</th>
                            <th class="px-6 py-4">Clicked At</th>
                            <th class="px-6 py-4">Source</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Update</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($enquiries as $enquiry)
                            <tr class="border-b align-top">
                                <td class="px-6 py-4">
                                    <div class="font-black">
                                        {{ $enquiry->event?->title ?? 'Deleted event' }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $enquiry->event?->event_code }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $enquiry->event?->company?->name ?? 'No company' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $enquiry->clicked_at?->format('M d, Y h:i A') ?? $enquiry->created_at->format('M d, Y h:i A') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-600">
                                        {{ $enquiry->source_page ?? 'event_detail' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($enquiry->status === 'confirmed')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                            Confirmed
                                        </span>
                                    @elseif($enquiry->status === 'cancelled')
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                            Cancelled
                                        </span>
                                    @elseif($enquiry->status === 'contacted')
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                            Contacted
                                        </span>
                                    @else
                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                            New
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('support.enquiries.update-status', $enquiry) }}">
                                        @csrf
                                        @method('PATCH')

                                        <div class="flex gap-2">
                                            <select name="status" class="rounded-xl border-gray-300 text-sm">
                                                <option value="new" @selected($enquiry->status === 'new')>New</option>
                                                <option value="contacted" @selected($enquiry->status === 'contacted')>Contacted</option>
                                                <option value="confirmed" @selected($enquiry->status === 'confirmed')>Confirmed</option>
                                                <option value="cancelled" @selected($enquiry->status === 'cancelled')>Cancelled</option>
                                            </select>

                                            <button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    No enquiries found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $enquiries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>