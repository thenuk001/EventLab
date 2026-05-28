<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with(['company', 'category', 'approvedBy'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'ILIKE', "%{$search}%")
                        ->orWhere('event_code', 'ILIKE', "%{$search}%")
                        ->orWhereHas('company', function ($companyQuery) use ($search) {
                            $companyQuery->where('name', 'ILIKE', "%{$search}%");
                        });
                });
            })
            ->when($request->approval_status, function ($query, $status) {
                $query->where('approval_status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('super-admin.events.index', compact('events'));
    }

    public function approve(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'approval_comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $event->update([
            'approval_status' => 'approved',
            'approval_comment' => $validated['approval_comment'] ?? 'Approved by Super Admin.',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'rejected_at' => null,
        ]);

        return back()->with('success', 'Event approved successfully.');
    }

    public function reject(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'approval_comment' => ['required', 'string', 'max:1000'],
        ]);

        $event->update([
            'approval_status' => 'rejected',
            'approval_comment' => $validated['approval_comment'],
            'approved_by' => auth()->id(),
            'approved_at' => null,
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Event rejected with comment.');
    }

    public function toggleFeatured(Event $event): RedirectResponse
    {
        $event->update([
            'is_featured' => ! $event->is_featured,
        ]);

        return back()->with('success', 'Featured status updated.');
    }
}