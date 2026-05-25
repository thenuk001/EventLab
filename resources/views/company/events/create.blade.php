<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Create Event
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            <form method="POST" action="{{ route('company.events.store') }}" class="rounded-3xl bg-white p-8 shadow">
                @csrf

                @include('company.events.partials.form', [
                    'event' => null,
                    'categories' => $categories,
                    'buttonText' => 'Create Event'
                ])
            </form>
        </div>
    </div>
</x-app-layout>