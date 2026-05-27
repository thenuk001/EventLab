<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    WhatsApp CTA Settings
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $event->title }}
                </p>
            </div>

            <a href="{{ route('company.events.index') }}"
               class="rounded-full bg-gray-100 px-5 py-2 text-sm font-bold text-gray-700">
                Back to Events
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 p-4 font-bold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-slate-900 via-green-800 to-orange-500 p-8 text-white">
                <h1 class="text-4xl font-black">WhatsApp Booking Message</h1>
                <p class="mt-3 text-slate-100">
                    Configure the button label and pre-filled WhatsApp message for this event.
                    All customers will be redirected to the official EventLab WhatsApp number.
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <form method="POST"
                      action="{{ route('company.events.whatsapp.update', $event) }}"
                      class="rounded-3xl bg-white p-8 shadow lg:col-span-2">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6">
                        <div class="rounded-2xl bg-green-50 p-5">
                            <p class="text-sm font-bold text-green-700">
                                Official EventLab Booking Number
                            </p>

                            <p class="mt-2 text-2xl font-black text-green-900">
                                {{ $eventlabWhatsappNumber }}
                            </p>

                            <p class="mt-2 text-sm text-green-700">
                                This number is controlled by EventLab. Company admins cannot change it.
                            </p>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Button Label
                            </label>

                            <input type="text"
                                   name="cta_label"
                                   value="{{ old('cta_label', $whatsappCta?->cta_label ?? 'Book on WhatsApp') }}"
                                   class="w-full rounded-2xl border-gray-300"
                                   required>

                            @error('cta_label')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">
                                Message Template
                            </label>

                            <textarea name="template_message"
                                      rows="8"
                                      class="w-full rounded-2xl border-gray-300"
                                      required>{{ old('template_message', $whatsappCta?->template_message ?? 'Hello EventLab, I would like to book tickets for [Event Name]. Event ID: [Event ID]. Date: [Date]. Ticket Type: [Standard/VIP]. Quantity: [ ]. My name is [ ]. Please confirm availability and payment details.') }}</textarea>

                            <p class="mt-2 text-sm text-gray-500">
                                Available placeholders:
                                <span class="font-bold">[Event Name]</span>,
                                <span class="font-bold">[Event ID]</span>,
                                <span class="font-bold">[Date]</span>
                            </p>

                            @error('template_message')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('company.events.index') }}"
                               class="font-bold text-gray-500">
                                Cancel
                            </a>

                            <button class="rounded-full bg-green-500 px-8 py-3 font-black text-white hover:bg-green-400">
                                Save Message Settings
                            </button>
                        </div>
                    </div>
                </form>

                @php
                    $previewPhone = $eventlabWhatsappNumber;

                    $previewTemplate = old('template_message', $whatsappCta?->template_message ?? 'Hello EventLab, I would like to book tickets for [Event Name]. Event ID: [Event ID]. Date: [Date]. Ticket Type: [Standard/VIP]. Quantity: [ ]. My name is [ ]. Please confirm availability and payment details.');

                    $previewMessage = str_replace(
                        ['[Event Name]', '[Event ID]', '[Date]'],
                        [$event->title, $event->event_code, $event->event_date->format('Y-m-d')],
                        $previewTemplate
                    );

                    $previewUrl = 'https://wa.me/' . $previewPhone . '?text=' . urlencode($previewMessage);
                @endphp

                <aside class="rounded-3xl bg-slate-900 p-6 text-white shadow">
                    <p class="text-sm font-black uppercase tracking-widest text-green-300">
                        Preview
                    </p>

                    <h3 class="mt-2 text-2xl font-black">
                        WhatsApp Button
                    </h3>

                    <div class="mt-6 rounded-2xl bg-white/10 p-5">
                        <p class="text-sm text-slate-400">EventLab Number</p>
                        <p class="mt-1 font-black text-green-300">{{ $previewPhone }}</p>
                    </div>

                    <div class="mt-4 rounded-2xl bg-white/10 p-5">
                        <p class="text-sm text-slate-400">Message</p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-200">
                            {{ $previewMessage }}
                        </p>
                    </div>

                    <a href="{{ $previewUrl }}"
                       target="_blank"
                       class="mt-6 block rounded-full bg-green-500 px-6 py-4 text-center font-black text-white hover:bg-green-400">
                        Open WhatsApp Preview
                    </a>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>