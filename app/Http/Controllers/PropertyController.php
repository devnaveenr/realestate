<?php

namespace App\Http\Controllers;

use App\Models\BhkType;
use App\Models\City;
use App\Models\Facing;
use App\Models\Furnishing;
use App\Models\Location;
use App\Models\Parking;
use App\Models\Property;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        return $this->getFilteredProperties($request);
    }

    public function indexBySlug(Request $request, $citySlug, $citySlug2 = null, $locationSlug = null)
    {
        $request->merge([
            'city_slug'     => $citySlug,
            'location_slug' => $locationSlug,
        ]);

        return $this->getFilteredProperties($request);
    }

    private function getFilteredProperties(Request $request)
    {
        $query = Property::with([
            'cityRelation',
            'locationRelation',
            'typeRelation',
            'statusRelation',
            'bhkRelation',
            'facingRelation',
            'furnishingRelation',
            'parkingRelation',
            'images',
        ])->where('status', 1);

        // Filter by City Slug or City ID
        if ($request->filled('city_slug')) {
            $query->where('city_slug', $request->city_slug);
        } elseif ($request->filled('city')) {
            $cityObj = is_numeric($request->city) ? City::find($request->city) : City::where('city_slug', $request->city)->first();
            if ($cityObj) {
                $query->where('city_slug', $cityObj->city_slug);
            }
        }

        // Filter by Location Slug or Location ID
        if ($request->filled('location_slug')) {
            $query->where('location_slug', $request->location_slug);
        } elseif ($request->filled('location')) {
            $locObj = is_numeric($request->location) ? Location::find($request->location) : Location::where('location_slug', $request->location)->first();
            if ($locObj) {
                $query->where('location_slug', $locObj->location_slug);
            }
        }

        // Keyword Filter
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('property_title', 'like', "%{$keyword}%")
                  ->orWhere('property_desc', 'like', "%{$keyword}%");
            });
        }

        // BHK Filter
        if ($request->filled('bhk_type')) {
            $bhk = is_array($request->bhk_type) ? $request->bhk_type : explode(',', $request->bhk_type);
            $query->whereIn('bhk_type', $bhk);
        }

        // Property Type Filter
        if ($request->filled('property_type')) {
            $ptype = is_array($request->property_type) ? $request->property_type : explode(',', $request->property_type);
            $query->whereIn('property_type', $ptype);
        }

        // Property Status Filter
        if ($request->filled('property_status')) {
            $query->where('property_status', $request->property_status);
        }

        // Furnishing Filter
        if ($request->filled('furnishing_type')) {
            $furn = is_array($request->furnishing_type) ? $request->furnishing_type : explode(',', $request->furnishing_type);
            $query->whereIn('furnishing_type', $furn);
        }

        // Parking Filter
        if ($request->filled('parking_type')) {
            $park = is_array($request->parking_type) ? $request->parking_type : explode(',', $request->parking_type);
            $query->whereIn('parking_type', $park);
        }

        // Sorting
        $sort = $request->get('sort', $request->get('sort_by', 'latest'));
        if ($sort === 'price_low' || $sort === 'pricelow') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high' || $sort === 'pricehigh') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'old') {
            $query->orderBy('id', 'asc');
        } else {
            $query->latest();
        }

        $properties = $query->paginate(9)->withQueryString();

        // Form Options
        $cities = City::all();
        $locations = Location::all();
        $propertyTypes = PropertyType::all();
        $bhkTypes = BhkType::all();
        $propertyStatuses = PropertyStatus::all();
        $facings = Facing::all();
        $furnishings = Furnishing::all();
        $parkings = Parking::all();

        $selectedCitySlug = $request->city_slug ?? ($request->filled('city') ? (City::find($request->city)->city_slug ?? $request->city) : '');
        $selectedLocationSlug = $request->location_slug ?? ($request->filled('location') ? (Location::find($request->location)->location_slug ?? $request->location) : '');

        return view('properties.index', compact(
            'properties',
            'cities',
            'locations',
            'propertyTypes',
            'bhkTypes',
            'propertyStatuses',
            'facings',
            'furnishings',
            'parkings',
            'selectedCitySlug',
            'selectedLocationSlug'
        ));
    }

    public function show($idOrSlug)
    {
        return $this->showBySlug($idOrSlug);
    }

    public function showBySlug($slug)
    {
        $property = Property::with([
            'cityRelation',
            'locationRelation',
            'typeRelation',
            'statusRelation',
            'bhkRelation',
            'facingRelation',
            'furnishingRelation',
            'parkingRelation',
            'images',
        ])
        ->where('property_slug', $slug)
        ->orWhere('id', $slug)
        ->firstOrFail();

        $relatedProperties = Property::with(['cityRelation', 'locationRelation', 'images', 'bhkRelation', 'typeRelation'])
            ->where('id', '!=', $property->id)
            ->where('city_slug', $property->city_slug)
            ->where('status', 1)
            ->take(3)
            ->get();

        return view('properties.show', compact('property', 'relatedProperties'));
    }

    public function getLocationsByCitySlug($citySlug)
    {
        $locations = Location::where('city_slug', $citySlug)->get();

        $html = '<option value="">Select Location</option>';
        foreach ($locations as $loc) {
            $html .= '<option value="' . e($loc->location_slug) . '">' . e($loc->location_name) . '</option>';
        }

        return response()->json(['html' => $html]);
    }
}
