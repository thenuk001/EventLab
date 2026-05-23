<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('support.dashboard');
    }
}