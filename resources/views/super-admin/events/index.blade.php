<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Event Approvals
            </h2>

            <a href="{{ route('super.dashboard') }}"
               class="rounded-full bg-slate-900 px-5 py-2 text-sm font-bold text-white">
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

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-purple-900 to-orange-600 p-8 text-white">
                <h1 class="text-4xl font-black">Review Events</h1>
                <p class="mt-3 text-slate-200">
                    Approve, reject, and feature company-submitted events before they appear publicly.
                </p>
            </div>

            <form method="GET" class="mb-6 grid gap-4 rounded-3xl bg-white p-5 shadow md:grid-cols-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search event, code, company..."
                       class="rounded-2xl border-gray-300">

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
                            <th class="px-6 py-4">Event</th>
                            <th class="px-6 py-4">Company</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Approval</th>
                            <th class="px-6 py-4">Featured</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($events as $event)
                            <tr class="border-b align-top">
                                <td class="px-6 py-4">
                                    <div class="font-black">{{ $event->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $event->event_code }}</div>

                                    @if($event->approval_status === 'approved' && $event->status === 'published')
                                        <a href="{{ route('events.show', $event) }}"
                                           target="_blank"
                                           class="mt-2 inline-block text-sm font-bold text-orange-600">
                                            View Public Page
                                        </a>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    {{ $event->company?->name ?? 'No company' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $event->category?->name ?? 'No category' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $event->event_date?->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($event->approval_status === 'approved')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                            Approved
                                        </span>
                                    @elseif($event->approval_status === 'rejected')
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
                                    @if($event->is_featured)
                                        <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700">
                                            Featured
                                        </span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-600">
                                            Normal
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-2">
                                        @if($event->approval_status !== 'approved')
                                            <form method="POST" action="{{ route('super.events.approve', $event) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="rounded-full bg-green-500 px-4 py-2 text-sm font-bold text-white hover:bg-green-400">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif

                                        @if($event->approval_status !== 'rejected')
                                            <form method="POST" action="{{ route('super.events.reject', $event) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="rounded-full bg-red-500 px-4 py-2 text-sm font-bold text-white hover:bg-red-400">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('super.events.toggle-featured', $event) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="rounded-full bg-purple-500 px-4 py-2 text-sm font-bold text-white hover:bg-purple-400">
                                                {{ $event->is_featured ? 'Unfeature' : 'Feature' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                                    No events found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>