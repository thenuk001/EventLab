<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use App\Models\WhatsappCta;
use Illuminate\Database\Seeder;

class TicketAndWhatsappSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::with('company')->get();

        foreach ($events as $event) {
            TicketType::firstOrCreate(
                [
                    'event_id' => $event->id,
                    'name' => 'Standard',
                ],
                [
                    'price' => 1500,
                    'quantity' => 100,
                    'sold_count' => 0,
                    'benefits' => 'General entry ticket.',
                    'availability_status' => 'available',
                ]
            );

            TicketType::firstOrCreate(
                [
                    'event_id' => $event->id,
                    'name' => 'VIP',
                ],
                [
                    'price' => 3500,
                    'quantity' => 50,
                    'sold_count' => 0,
                    'benefits' => 'Priority entry and premium seating.',
                    'availability_status' => 'available',
                ]
            );

            WhatsappCta::firstOrCreate(
                ['event_id' => $event->id],
                [
                    'booking_number' => $event->company->whatsapp_number ?? '94771234567',
                    'support_number' => $event->company->whatsapp_number ?? '94771234567',
                    'cta_label' => 'Book on WhatsApp',
                    'template_message' => 'Hello EventLab, I would like to book tickets for [Event Name]. Event ID: [Event ID]. Date: [Date]. Ticket Type: [Standard/VIP]. Quantity: [ ]. My name is [ ]. Please confirm availability and payment details.',
                ]
            );
        }
    }
}