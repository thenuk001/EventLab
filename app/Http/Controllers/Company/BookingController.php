<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $bookings = Booking::with(['event', 'ticketType', 'qrTickets'])
            ->where('company_id', $companyId)
            ->latest()
            ->paginate(15);

        return view('company.bookings.index', compact('bookings'));
    }

    public function createFromEnquiry(Enquiry $enquiry)
    {
        abort_unless($enquiry->company_id === auth()->user()->company_id, 403);

        $enquiry->load(['event.ticketTypes', 'booking']);

        if ($enquiry->booking) {
            return redirect()
                ->route('company.bookings.index')
                ->with('success', 'This enquiry already has a booking.');
        }

        return view('company.bookings.create-from-enquiry', compact('enquiry'));
    }

    public function storeFromEnquiry(Request $request, Enquiry $enquiry): RedirectResponse
    {
        abort_unless($enquiry->company_id === auth()->user()->company_id, 403);

        $enquiry->load(['event.ticketTypes', 'booking']);

        if ($enquiry->booking) {
            return redirect()
                ->route('company.bookings.index')
                ->with('success', 'This enquiry already has a booking.');
        }

        $validated = $request->validate([
            'ticket_type_id' => ['required', 'exists:ticket_types,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
            'payment_status' => ['required', 'in:manual_pending,paid,unpaid,refunded'],
            'notes' => ['nullable', 'string'],
        ]);

        $ticketType = $enquiry->event->ticketTypes()
            ->where('id', $validated['ticket_type_id'])
            ->firstOrFail();

        $quantity = (int) $validated['quantity'];
        $unitPrice = $ticketType->price;
        $totalAmount = $unitPrice * $quantity;

        $booking = Booking::create([
            'company_id' => $enquiry->company_id,
            'event_id' => $enquiry->event_id,
            'ticket_type_id' => $ticketType->id,
            'enquiry_id' => $enquiry->id,
            'booking_code' => 'BKG-' . strtoupper(Str::random(8)),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'customer_email' => $validated['customer_email'] ?? null,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_amount' => $totalAmount,
            'status' => 'confirmed',
            'payment_status' => $validated['payment_status'],
            'notes' => $validated['notes'] ?? null,
        ]);

        for ($i = 1; $i <= $quantity; $i++) {
            $booking->qrTickets()->create([
                'event_id' => $booking->event_id,
                'ticket_type_id' => $ticketType->id,
                'ticket_code' => 'QR-' . strtoupper(Str::random(10)),
                'holder_name' => $validated['customer_name'],
                'status' => 'valid',
            ]);
        }

        $ticketType->increment('sold_count', $quantity);

        $enquiry->update([
            'status' => 'confirmed',
            'ticket_type_id' => $ticketType->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'quantity' => $quantity,
        ]);

        return redirect()
            ->route('company.bookings.index')
            ->with('success', 'Booking created and QR tickets generated successfully.');
    }
}