<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                My Events
            </h2>

            <a href="{{ route('company.events.create') }}"
               class="rounded-full bg-orange-500 px-5 py-2 text-sm font-bold text-white">
                Create Event
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

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-blue-900 to-green-600 p-8 text-white shadow-xl">
                <h1 class="text-4xl font-black">My Company Events</h1>
                <p class="mt-3 text-slate-200">
                    Manage your events, tickets, WhatsApp message settings, and view Super Admin approval feedback.
                </p>
            </div>

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
                                <span class="mt-2 inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>

                            <div class="lg:col-span-2">
                                <p class="text-sm font-bold text-gray-500">Approval</p>

                                @if($event->approval_status === 'approved')
                                    <span class="mt-2 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                        Approved
                                    </span>
                                @elseif($event->approval_status === 'rejected')
                                    <span class="mt-2 inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                        Rejected
                                    </span>
                                @else
                                    <span class="mt-2 inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($event->approval_comment)
                            <div class="mt-6 rounded-2xl
                                @if($event->approval_status === 'approved') bg-green-50 border border-green-100
                                @elseif($event->approval_status === 'rejected') bg-red-50 border border-red-100
                                @else bg-orange-50 border border-orange-100
                                @endif
                                p-5">
                                <p class="text-sm font-black
                                    @if($event->approval_status === 'approved') text-green-800
                                    @elseif($event->approval_status === 'rejected') text-red-800
                                    @else text-orange-800
                                    @endif">
                                    Super Admin Comment
                                </p>

                                <p class="mt-2 text-sm leading-6 text-gray-700">
                                    {{ $event->approval_comment }}
                                </p>

                                <p class="mt-3 text-xs font-bold text-gray-500">
                                    @if($event->approved_at)
                                        Approved on {{ $event->approved_at->format('M d, Y h:i A') }}
                                    @elseif($event->rejected_at)
                                        Rejected on {{ $event->rejected_at->format('M d, Y h:i A') }}
                                    @else
                                        Waiting for final decision
                                    @endif
                                </p>
                            </div>
                        @else
                            <div class="mt-6 rounded-2xl border border-orange-100 bg-orange-50 p-5">
                                <p class="text-sm font-black text-orange-800">
                                    Approval Feedback
                                </p>

                                <p class="mt-2 text-sm text-gray-600">
                                    No comment yet. This event is waiting for Super Admin review.
                                </p>
                            </div>
                        @endif

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('company.events.edit', $event) }}"
                               class="rounded-full bg-orange-500 px-5 py-2 text-sm font-bold text-white hover:bg-orange-400">
                                Edit
                            </a>

                            <a href="{{ route('company.events.tickets.index', $event) }}"
                               class="rounded-full bg-green-500 px-5 py-2 text-sm font-bold text-white hover:bg-green-400">
                                Tickets
                            </a>

                            <a href="{{ route('company.events.whatsapp.edit', $event) }}"
                               class="rounded-full bg-blue-500 px-5 py-2 text-sm font-bold text-white hover:bg-blue-400">
                                WhatsApp
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="rounded-3xl bg-white p-10 text-center text-gray-500 shadow">
                        No events yet. Create your first event.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>