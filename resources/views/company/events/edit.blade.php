<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Event
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            <form method="POST" action="{{ route('company.events.update', $event) }}" class="rounded-3xl bg-white p-8 shadow">
                @csrf
                @method('PUT')

                @include('company.events.partials.form', [
                    'event' => $event,
                    'categories' => $categories,
                    'buttonText' => 'Update Event'
                ])
            </form>
        </div>
    </div>
</x-app-layout>