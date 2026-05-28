<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\CheckIn;
use App\Models\QrTicket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $ticketCode = strtoupper(trim($validated['ticket_code']));

        $qrTicket = QrTicket::with([
                'booking.company',
                'event',
                'ticketType',
                'checkedInBy',
            ])
            ->where('ticket_code', $ticketCode)
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
        $qrTicket->load([
            'booking.company',
            'event',
            'ticketType',
            'checkedInBy',
        ]);

        if ($qrTicket->status === 'checked_in' || $qrTicket->checked_in_at) {
            return redirect()
                ->route('support.check-in.index')
                ->with('error', 'This ticket has already been checked in.');
        }

        if ($qrTicket->status === 'cancelled') {
            return redirect()
                ->route('support.check-in.index')
                ->with('error', 'This ticket is cancelled and cannot be checked in.');
        }

        DB::transaction(function () use ($qrTicket) {
            $qrTicket->update([
                'status' => 'checked_in',
                'checked_in_at' => now(),
                'checked_in_by' => auth()->id(),
            ]);

            CheckIn::create([
                'qr_ticket_id' => $qrTicket->id,
                'event_id' => $qrTicket->event_id,
                'checked_in_by' => auth()->id(),
                'checked_in_at' => now(),
                'method' => 'manual',
                'notes' => 'Manual check-in by support staff.',
            ]);
        });

        return redirect()
            ->route('support.check-in.index')
            ->with('success', 'Ticket checked in successfully.');
    }

    public function scan(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ticket_code' => ['required', 'string', 'max:255'],
        ]);

        $ticketCode = strtoupper(trim($validated['ticket_code']));

        $qrTicket = QrTicket::with([
                'booking.company',
                'event',
                'ticketType',
                'checkedInBy',
            ])
            ->where('ticket_code', $ticketCode)
            ->first();

        if (! $qrTicket) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Invalid QR ticket. This ticket code was not found.',
            ], 404);
        }

        if ($qrTicket->status === 'cancelled') {
            return response()->json([
                'status' => 'cancelled',
                'message' => 'This ticket is cancelled and cannot be checked in.',
                'ticket' => $this->ticketPayload($qrTicket),
            ], 422);
        }

        if ($qrTicket->status === 'checked_in' || $qrTicket->checked_in_at) {
            return response()->json([
                'status' => 'already_checked_in',
                'message' => 'This ticket has already been checked in.',
                'ticket' => $this->ticketPayload($qrTicket),
            ], 409);
        }

        DB::transaction(function () use ($qrTicket) {
            $qrTicket->update([
                'status' => 'checked_in',
                'checked_in_at' => now(),
                'checked_in_by' => auth()->id(),
            ]);

            CheckIn::create([
                'qr_ticket_id' => $qrTicket->id,
                'event_id' => $qrTicket->event_id,
                'checked_in_by' => auth()->id(),
                'checked_in_at' => now(),
                'method' => 'camera_scan',
                'notes' => 'QR ticket checked in using camera scanner.',
            ]);
        });

        $qrTicket->refresh()->load([
            'booking.company',
            'event',
            'ticketType',
            'checkedInBy',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Ticket validated successfully.',
            'ticket' => $this->ticketPayload($qrTicket),
        ]);
    }

    private function ticketPayload(QrTicket $qrTicket): array
    {
        return [
            'id' => $qrTicket->id,
            'code' => $qrTicket->ticket_code,
            'holder' => $qrTicket->holder_name,
            'status' => $qrTicket->status,
            'event' => $qrTicket->event?->title,
            'event_code' => $qrTicket->event?->event_code,
            'ticket_type' => $qrTicket->ticketType?->name,
            'company' => $qrTicket->booking?->company?->name,
            'booking_code' => $qrTicket->booking?->booking_code,
            'checked_in_at' => $qrTicket->checked_in_at
                ? $qrTicket->checked_in_at->format('M d, Y h:i A')
                : null,
            'checked_in_by' => $qrTicket->checkedInBy?->name,
        ];
    }
}