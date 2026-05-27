<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::count();

        $approvedCompanies = Company::where('approval_status', 'approved')->count();

        $pendingCompanies = Company::where('approval_status', 'pending')->count();

        $totalUsers = User::count();

        return view('super-admin.dashboard', compact(
            'totalCompanies',
            'approvedCompanies',
            'pendingCompanies',
            'totalUsers'
        ));
    }
}