<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CheckIn;
use App\Models\Enquiry;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company;

        $activeEvents = Event::where('company_id', $company->id)
            ->where('status', 'published')
            ->where('approval_status', 'approved')
            ->count();

        $whatsappClicks = Enquiry::where('company_id', $company->id)
            ->count();

        $bookings = Booking::where('company_id', $company->id)
            ->count();

        $qrCheckIns = CheckIn::whereHas('event', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->count();

        return view('company.dashboard', [
            'company' => $company,
            'activeEvents' => $activeEvents,
            'whatsappClicks' => $whatsappClicks,
            'bookings' => $bookings,
            'qrCheckIns' => $qrCheckIns,
        ]);
    }
}