<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company;

        $events = Event::with('category')
            ->where('company_id', $company->id)
            ->latest()
            ->paginate(10);

        return view('company.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();

        return view('company.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $company = auth()->user()->company;

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'venue' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'map_url' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        Event::create([
            'company_id' => $company->id,
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . strtolower(Str::random(5)),
            'event_code' => 'EVT-' . strtoupper(Str::random(6)),
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'venue' => $validated['venue'] ?? null,
            'city' => $validated['city'] ?? null,
            'map_url' => $validated['map_url'] ?? null,
            'status' => $validated['status'],
            'approval_status' => 'pending',
            'is_featured' => false,
        ]);

        return redirect()
            ->route('company.events.index')
            ->with('success', 'Event created successfully and sent for approval.');
    }

    public function edit(Event $event)
    {
        $company = auth()->user()->company;

        abort_unless($event->company_id === $company->id, 403);

        $categories = Category::where('is_active', true)->get();

        return view('company.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $company = auth()->user()->company;

        abort_unless($event->company_id === $company->id, 403);

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'venue' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'map_url' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $event->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'venue' => $validated['venue'] ?? null,
            'city' => $validated['city'] ?? null,
            'map_url' => $validated['map_url'] ?? null,
            'status' => $validated['status'],
            'approval_status' => 'pending',
        ]);

        return redirect()
            ->route('company.events.index')
            ->with('success', 'Event updated successfully and sent for approval.');
    }
}