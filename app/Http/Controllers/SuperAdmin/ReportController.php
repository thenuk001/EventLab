<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Company;
use App\Models\Enquiry;
use App\Models\Event;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::count();
        $activeCompanies = Company::where('status', 'active')->count();
        $approvedCompanies = Company::where('approval_status', 'approved')->count();
        $pendingCompanies = Company::where('approval_status', 'pending')->count();

        $totalUsers = User::count();

        $totalEvents = Event::count();
        $publishedEvents = Event::where('status', 'published')->count();
        $pendingEvents = Event::where('approval_status', 'pending')->count();

        $whatsAppEnquiries = Enquiry::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $whatsAppClicks = Event::sum('whatsapp_clicks_count');

        return view('super-admin.reports.index', compact(
            'totalCompanies',
            'activeCompanies',
            'approvedCompanies',
            'pendingCompanies',
            'totalUsers',
            'totalEvents',
            'publishedEvents',
            'pendingEvents',
            'whatsAppEnquiries',
            'confirmedBookings',
            'whatsAppClicks'
        ));
    }
}