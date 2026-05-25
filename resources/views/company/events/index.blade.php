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

            <div class="overflow-hidden rounded-3xl bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4">Event</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Approval</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($events as $event)
                            <tr class="border-b">
                                <td class="px-6 py-4">
                                    <div class="font-black">{{ $event->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $event->event_code }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $event->category->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $event->event_date->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                        {{ ucfirst($event->approval_status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('company.events.edit', $event) }}"
                                           class="font-bold text-orange-600">
                                            Edit
                                        </a>

                                        <a href="{{ route('company.events.tickets.index', $event) }}"
                                           class="font-bold text-green-600">
                                            Tickets
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    No events yet. Create your first event.
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