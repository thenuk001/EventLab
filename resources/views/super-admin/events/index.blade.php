<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Event Management
            </h2>

            <div class="flex gap-3">
                <a href="{{ route('super.events.create') }}"
                   class="rounded-full bg-orange-500 px-5 py-2 text-sm font-bold text-white hover:bg-orange-400">
                    Create Event
                </a>

                <a href="{{ route('super.dashboard') }}"
                   class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200">
                    Back to Dashboard
                </a>
            </div>
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
                <h1 class="text-4xl font-black">Review Company Events</h1>
                <p class="mt-3 text-slate-200">
                    Approve, reject, comment, feature, and create company events before they appear publicly.
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

            <div class="space-y-6">
                @forelse($events as $event)
                    <div class="rounded-3xl bg-white p-6 shadow">
                        <div class="grid gap-6 lg:grid-cols-12">
                            <div class="lg:col-span-4">
                                <p class="text-sm font-bold text-gray-500">Event</p>

                                <h3 class="mt-1 text-xl font-black">
                                    {{ $event->title }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $event->event_code }}
                                </p>

                                @if($event->approval_status === 'approved' && $event->status === 'published')
                                    <a href="{{ route('events.show', $event) }}"
                                       target="_blank"
                                       class="mt-3 inline-block text-sm font-bold text-orange-600 hover:underline">
                                        View Public Page
                                    </a>
                                @endif
                            </div>

                            <div class="lg:col-span-2">
                                <p class="text-sm font-bold text-gray-500">Company</p>
                                <p class="mt-1 font-bold">
                                    {{ $event->company?->name ?? 'No company' }}
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <p class="text-sm font-bold text-gray-500">Category</p>
                                <p class="mt-1 font-bold">
                                    {{ $event->category?->name ?? 'No category' }}
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <p class="text-sm font-bold text-gray-500">Date</p>
                                <p class="mt-1 font-bold">
                                    {{ $event->event_date?->format('M d, Y') }}
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <p class="text-sm font-bold text-gray-500">Status</p>

                                <div class="mt-2 flex flex-wrap gap-2">
                                    @if($event->status === 'published')
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                            Published
                                        </span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700">
                                            Draft
                                        </span>
                                    @endif

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

                                    @if($event->is_featured)
                                        <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700">
                                            Featured
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-6 lg:grid-cols-2">
                            <div class="rounded-2xl bg-gray-50 p-5">
                                <h4 class="font-black text-gray-900">Event Summary</h4>

                                <div class="mt-3 grid gap-3 text-sm text-gray-600 md:grid-cols-2">
                                    <p>
                                        <span class="font-bold text-gray-800">Venue:</span>
                                        {{ $event->venue ?? 'N/A' }}
                                    </p>

                                    <p>
                                        <span class="font-bold text-gray-800">City:</span>
                                        {{ $event->city ?? 'N/A' }}
                                    </p>

                                    <p>
                                        <span class="font-bold text-gray-800">Start:</span>
                                        {{ $event->start_time ? \Illuminate\Support\Str::of($event->start_time)->substr(0, 5) : 'N/A' }}
                                    </p>

                                    <p>
                                        <span class="font-bold text-gray-800">End:</span>
                                        {{ $event->end_time ? \Illuminate\Support\Str::of($event->end_time)->substr(0, 5) : 'N/A' }}
                                    </p>
                                </div>

                                <p class="mt-4 text-sm leading-6 text-gray-600">
                                    {{ \Illuminate\Support\Str::limit($event->description, 220) }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5">
                                <h4 class="font-black text-gray-900">Approval Comment</h4>

                                @if($event->approval_comment)
                                    <p class="mt-3 rounded-2xl bg-white p-4 text-sm leading-6 text-gray-700">
                                        {{ $event->approval_comment }}
                                    </p>
                                @else
                                    <p class="mt-3 text-sm text-gray-500">
                                        No approval comment yet.
                                    </p>
                                @endif

                                @if($event->approvedBy)
                                    <p class="mt-3 text-xs font-bold text-gray-500">
                                        Updated by {{ $event->approvedBy->name }}

                                        @if($event->approved_at)
                                            • Approved {{ $event->approved_at->format('M d, Y h:i A') }}
                                        @endif

                                        @if($event->rejected_at)
                                            • Rejected {{ $event->rejected_at->format('M d, Y h:i A') }}
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 lg:grid-cols-3">
                            <form method="POST"
                                  action="{{ route('super.events.approve', $event) }}"
                                  class="rounded-2xl border border-green-100 bg-green-50 p-4">
                                @csrf
                                @method('PATCH')

                                <label class="mb-2 block text-sm font-bold text-green-800">
                                    Approval Comment
                                </label>

                                <textarea name="approval_comment"
                                          rows="3"
                                          class="w-full rounded-xl border-green-200 text-sm"
                                          placeholder="Optional approval note...">{{ old('approval_comment') }}</textarea>

                                <button class="mt-3 w-full rounded-xl bg-green-500 px-4 py-3 text-sm font-black text-white hover:bg-green-400">
                                    Approve Event
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('super.events.reject', $event) }}"
                                  class="rounded-2xl border border-red-100 bg-red-50 p-4">
                                @csrf
                                @method('PATCH')

                                <label class="mb-2 block text-sm font-bold text-red-800">
                                    Rejection Reason
                                </label>

                                <textarea name="approval_comment"
                                          rows="3"
                                          class="w-full rounded-xl border-red-200 text-sm"
                                          placeholder="Required reason for rejection..." required>{{ old('approval_comment') }}</textarea>

                                <button class="mt-3 w-full rounded-xl bg-red-500 px-4 py-3 text-sm font-black text-white hover:bg-red-400">
                                    Reject Event
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('super.events.toggle-featured', $event) }}"
                                  class="rounded-2xl border border-purple-100 bg-purple-50 p-4">
                                @csrf
                                @method('PATCH')

                                <p class="text-sm font-bold text-purple-800">
                                    Featured Status
                                </p>

                                <p class="mt-2 text-sm text-purple-700">
                                    Featured events can be highlighted on the public landing page.
                                </p>

                                <button class="mt-6 w-full rounded-xl bg-purple-500 px-4 py-3 text-sm font-black text-white hover:bg-purple-400">
                                    {{ $event->is_featured ? 'Unfeature Event' : 'Feature Event' }}
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="rounded-3xl bg-white p-10 text-center text-gray-500 shadow">
                        No events found.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>