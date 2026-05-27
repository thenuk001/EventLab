<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Event;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function redirect(Request $request, Event $event)
    {
        abort_unless(
            $event->status === 'published' && $event->approval_status === 'approved',
            404
        );

        $event->load(['company', 'whatsappCta']);

        Enquiry::create([
            'event_id' => $event->id,
            'company_id' => $event->company_id,
            'ticket_type_id' => $request->input('ticket_type_id'),
            'cta_type' => 'book',
            'status' => 'new',
            'source_page' => $request->input('source_page', 'event_detail'),
            'clicked_at' => now(),
        ]);

        $event->increment('whatsapp_clicks_count');

        $cta = $event->whatsappCta;

        $phone = $cta?->booking_number
            ?? $event->company->whatsapp_number
            ?? '94771234567';

        $template = $cta?->template_message
            ?? 'Hello EventLab, I would like to book tickets for [Event Name]. Event ID: [Event ID]. Date: [Date]. Ticket Type: [Standard/VIP]. Quantity: [ ]. My name is [ ]. Please confirm availability and payment details.';

        $message = str_replace(
            ['[Event Name]', '[Event ID]', '[Date]'],
            [$event->title, $event->event_code, $event->event_date->format('Y-m-d')],
            $template
        );

        $waUrl = 'https://wa.me/' . $phone . '?text=' . urlencode($message);

        return redirect()->away($waUrl);
    }
}