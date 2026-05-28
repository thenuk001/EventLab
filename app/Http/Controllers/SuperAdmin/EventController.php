<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function create()
    {
        $companies = Company::where('status', 'active')
            ->where('approval_status', 'approved')
            ->orderBy('name')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('super-admin.events.create', compact('companies', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['nullable'],
            'venue' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'map_url' => ['nullable', 'url', 'max:1000'],
            'status' => ['required', 'in:draft,published'],
            'approval_status' => ['required', 'in:pending,approved'],
            'is_featured' => ['nullable', 'boolean'],
            'approval_comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $company = Company::where('id', $validated['company_id'])
            ->where('status', 'active')
            ->where('approval_status', 'approved')
            ->firstOrFail();

        $approvalStatus = $validated['approval_status'];

        Event::create([
            'company_id' => $company->id,
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . strtolower(Str::random(5)),
            'event_code' => 'EVT-' . strtoupper(Str::random(6)),
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? null,
            'venue' => $validated['venue'],
            'city' => $validated['city'],
            'map_url' => $validated['map_url'] ?? null,
            'status' => $validated['status'],
            'approval_status' => $approvalStatus,
            'approval_comment' => $validated['approval_comment'] ?? 'Created by Super Admin.',
            'approved_by' => $approvalStatus === 'approved' ? auth()->id() : null,
            'approved_at' => $approvalStatus === 'approved' ? now() : null,
            'rejected_at' => null,
            'is_featured' => $request->boolean('is_featured'),
            'views_count' => 0,
            'whatsapp_clicks_count' => 0,
        ]);

        return redirect()
            ->route('super.events.index')
            ->with('success', 'Event created successfully on behalf of company.');
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