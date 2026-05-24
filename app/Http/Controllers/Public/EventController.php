<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->get();

        $events = Event::with(['category', 'company', 'ticketTypes'])
            ->where('status', 'published')
            ->where('approval_status', 'approved')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'ILIKE', "%{$search}%")
                        ->orWhere('venue', 'ILIKE', "%{$search}%")
                        ->orWhere('city', 'ILIKE', "%{$search}%");
                });
            })
            ->when($request->category, function ($query, $category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('public.events.index', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        abort_unless(
            $event->status === 'published' && $event->approval_status === 'approved',
            404
        );

        $event->increment('views_count');

        $event->load(['category', 'company', 'ticketTypes', 'whatsappCta']);

        return view('public.events.show', compact('event'));
    }
}