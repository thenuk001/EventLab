<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class DashboardRedirectController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            return redirect()->route('super.dashboard');
        }

        if ($user->hasRole('company_admin')) {
            return redirect()->route('company.dashboard');
        }

        if ($user->hasRole('support_staff')) {
            return redirect()->route('support.dashboard');
        }

        return redirect()->route('home');
    }
}