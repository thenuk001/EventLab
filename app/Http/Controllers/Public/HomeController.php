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
            ->take(5)
            ->get();

        $featuredEvents = Event::with(['category', 'company', 'ticketTypes'])
            ->where('status', 'published')
            ->where('approval_status', 'approved')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $latestEvents = Event::with(['category', 'company', 'ticketTypes'])
            ->where('status', 'published')
            ->where('approval_status', 'approved')
            ->latest()
            ->take(3)
            ->get();

        return view('public.home', compact('categories', 'featuredEvents', 'latestEvents'));
    }
}