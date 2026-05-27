<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $enquiries = Enquiry::with(['event.company', 'ticketType'])
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                $query->whereHas('event', function ($eventQuery) use ($search) {
                    $eventQuery->where('title', 'ILIKE', "%{$search}%")
                        ->orWhere('event_code', 'ILIKE', "%{$search}%");
                })->orWhereHas('company', function ($companyQuery) use ($search) {
                    $companyQuery->where('name', 'ILIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('support.enquiries.index', compact('enquiries'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,confirmed,cancelled'],
        ]);

        $enquiry->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Enquiry status updated successfully.');
    }
}