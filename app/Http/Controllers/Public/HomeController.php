<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $featuredEvents = Event::with(['category', 'company', 'ticketTypes'])
            ->where('status', 'published')
            ->where('approval_status', 'approved')
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $latestEvents = Event::with(['category', 'company', 'ticketTypes'])
            ->where('status', 'published')
            ->where('approval_status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('categories', 'featuredEvents', 'latestEvents'));
    }
}