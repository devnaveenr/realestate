<?php

namespace App\Http\Controllers;

use App\Models\BhkType;
use App\Models\City;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $slides = Slide::where('slide_status', 1)->orderBy('slide_priority', 'asc')->get();
        $cities = City::withCount('properties')->get();
        $locations = Location::all();
        $propertyTypes = PropertyType::all();
        $bhkTypes = BhkType::all();
        $propertyStatuses = PropertyStatus::all();

        // Featured & Recent Properties with eager loading
        $featuredProperties = Property::with([
            'cityRelation',
            'locationRelation',
            'typeRelation',
            'statusRelation',
            'bhkRelation',
            'images',
        ])
        ->where('status', 1)
        ->latest()
        ->take(6)
        ->get();

        return view('home', compact(
            'slides',
            'cities',
            'locations',
            'propertyTypes',
            'bhkTypes',
            'propertyStatuses',
            'featuredProperties'
        ));
    }
}
