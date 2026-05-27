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
        $eventlabWhatsappNumber = config('services.eventlab.whatsapp_number');

        return view('company.whatsapp.edit', compact(
            'event',
            'whatsappCta',
            'eventlabWhatsappNumber'
        ));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->ensureCompanyOwnsEvent($event);

        $validated = $request->validate([
            'cta_label' => ['required', 'string', 'max:100'],
            'template_message' => ['required', 'string'],
        ]);

        $event->whatsappCta()->updateOrCreate(
            ['event_id' => $event->id],
            [
                'booking_number' => config('services.eventlab.whatsapp_number'),
                'support_number' => config('services.eventlab.whatsapp_number'),
                'cta_label' => $validated['cta_label'],
                'template_message' => $validated['template_message'],
            ]
        );

        return redirect()
            ->route('company.events.whatsapp.edit', $event)
            ->with('success', 'WhatsApp message settings updated successfully.');
    }
}