<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\CheckIn;
use App\Models\QrTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function index()
    {
        return view('support.check-in.index');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'ticket_code' => ['required', 'string', 'max:255'],
        ]);

        $qrTicket = QrTicket::with(['booking.company', 'event', 'ticketType'])
            ->where('ticket_code', strtoupper(trim($validated['ticket_code'])))
            ->first();

        if (! $qrTicket) {
            return back()
                ->withInput()
                ->with('error', 'Ticket code not found.');
        }

        return view('support.check-in.result', compact('qrTicket'));
    }

    public function confirm(QrTicket $qrTicket): RedirectResponse
    {
        $qrTicket->load(['booking', 'event']);

        if ($qrTicket->status === 'checked_in') {
            return redirect()
                ->route('support.check-in.index')
                ->with('error', 'This ticket has already been checked in.');
        }

        if ($qrTicket->status === 'cancelled') {
            return redirect()
                ->route('support.check-in.index')
                ->with('error', 'This ticket is cancelled and cannot be checked in.');
        }

        $qrTicket->update([
            'status' => 'checked_in',
            'checked_in_at' => now(),
        ]);

        CheckIn::create([
            'qr_ticket_id' => $qrTicket->id,
            'event_id' => $qrTicket->event_id,
            'checked_in_by' => auth()->id(),
            'checked_in_at' => now(),
            'method' => 'manual',
            'notes' => 'Manual check-in by support staff.',
        ]);

        return redirect()
            ->route('support.check-in.index')
            ->with('success', 'Ticket checked in successfully.');
    }
}