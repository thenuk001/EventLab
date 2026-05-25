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
        $events = Event::with(['company', 'category'])
            ->when($request->approval_status, function ($query, $status) {
                $query->where('approval_status', $status);
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'ILIKE', "%{$search}%")
                        ->orWhere('event_code', 'ILIKE', "%{$search}%")
                        ->orWhereHas('company', function ($companyQuery) use ($search) {
                            $companyQuery->where('name', 'ILIKE', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('super-admin.events.index', compact('events'));
    }

    public function approve(Event $event): RedirectResponse
    {
        $event->update([
            'approval_status' => 'approved',
            'status' => 'published',
        ]);

        return back()->with('success', 'Event approved successfully.');
    }

    public function reject(Event $event): RedirectResponse
    {
        $event->update([
            'approval_status' => 'rejected',
        ]);

        return back()->with('success', 'Event rejected successfully.');
    }

    public function toggleFeatured(Event $event): RedirectResponse
    {
        $event->update([
            'is_featured' => ! $event->is_featured,
        ]);

        return back()->with('success', 'Featured status updated successfully.');
    }
}