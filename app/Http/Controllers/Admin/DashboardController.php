<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Property;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count();
        $activeProperties = Property::where('status', 1)->count();
        $totalCities = City::count();
        $totalLocations = Location::count();
        $totalInquiries = Contact::count();
        $recentInquiries = Contact::with('property')->latest()->take(5)->get();
        $recentProperties = Property::with(['cityRelation', 'locationRelation', 'typeRelation'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProperties',
            'activeProperties',
            'totalCities',
            'totalLocations',
            'totalInquiries',
            'recentInquiries',
            'recentProperties'
        ));
    }
}
