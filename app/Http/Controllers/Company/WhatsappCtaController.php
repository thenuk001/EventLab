<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WhatsappCtaController extends Controller
{
    private function ensureCompanyOwnsEvent(Event $event): void
    {
        abort_unless($event->company_id === auth()->user()->company_id, 403);
    }

    public function edit(Event $event)
    {
        $this->ensureCompanyOwnsEvent($event);

        $event->load(['whatsappCta', 'company']);

        $whatsappCta = $event->whatsappCta;

        return view('company.whatsapp.edit', compact('event', 'whatsappCta'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->ensureCompanyOwnsEvent($event);

        $validated = $request->validate([
            'booking_number' => ['required', 'string', 'max:30'],
            'support_number' => ['nullable', 'string', 'max:30'],
            'cta_label' => ['required', 'string', 'max:100'],
            'template_message' => ['required', 'string'],
        ]);

        $event->whatsappCta()->updateOrCreate(
            ['event_id' => $event->id],
            [
                'booking_number' => $validated['booking_number'],
                'support_number' => $validated['support_number'] ?? null,
                'cta_label' => $validated['cta_label'],
                'template_message' => $validated['template_message'],
            ]
        );

        return redirect()
            ->route('company.events.whatsapp.edit', $event)
            ->with('success', 'WhatsApp settings updated successfully.');
    }
}