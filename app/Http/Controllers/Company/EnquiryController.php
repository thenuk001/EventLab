<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $enquiries = Enquiry::with(['event', 'ticketType'])
            ->where('company_id', $companyId)
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('company.enquiries.index', compact('enquiries'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry): RedirectResponse
    {
        abort_unless($enquiry->company_id === auth()->user()->company_id, 403);

        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,confirmed,cancelled'],
        ]);

        $enquiry->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Enquiry status updated.');
    }
}