<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CheckIn;
use App\Models\Enquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $newEnquiries = Enquiry::where('status', 'new')->count();

        $contactedEnquiries = Enquiry::where('status', 'contacted')->count();

        $confirmedBookings = Booking::where('status', 'confirmed')->count();

        $qrCheckIns = CheckIn::count();

        return view('support.dashboard', [
            'newEnquiries' => $newEnquiries,
            'contactedEnquiries' => $contactedEnquiries,
            'confirmedBookings' => $confirmedBookings,
            'qrCheckIns' => $qrCheckIns,
        ]);
    }
}