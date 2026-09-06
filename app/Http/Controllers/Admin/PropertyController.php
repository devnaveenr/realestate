<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BhkType;
use App\Models\City;
use App\Models\Facing;
use App\Models\Furnishing;
use App\Models\Location;
use App\Models\Parking;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with(['cityRelation', 'locationRelation', 'typeRelation', 'statusRelation'])
            ->latest()
            ->paginate(15);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $cities = City::all();
        $locations = Location::all();
        $propertyTypes = PropertyType::all();
        $bhkTypes = BhkType::all();
        $propertyStatuses = PropertyStatus::all();
        $facings = Facing::all();
        $furnishings = Furnishing::all();
        $parkings = Parking::all();

        return view('admin.properties.create', compact(
            'cities',
            'locations',
            'propertyTypes',
            'bhkTypes',
            'propertyStatuses',
            'facings',
            'furnishings',
            'parkings'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_title'  => 'required|string|max:255',
            'property_type'   => 'required|integer',
            'property_desc'   => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'property_size'   => 'nullable|string|max:255',
            'facing'          => 'nullable|integer',
            'bhk_type'        => 'nullable|integer',
            'bathrooms'       => 'nullable|integer',
            'property_status' => 'nullable|integer',
            'furnishing_type' => 'nullable|integer',
            'parking_type'    => 'nullable|integer',
            'city'            => 'required|integer',
            'location'        => 'required|integer',
            'status'          => 'required|integer',
            'images.*'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $city = City::find($validated['city']);
        $location = Location::find($validated['location']);

        $slug = Str::slug($validated['property_title']);

        $property = Property::create([
            'property_title'  => $validated['property_title'],
            'property_type'   => $validated['property_type'],
            'property_desc'   => $validated['property_desc'] ?? '',
            'price'           => $validated['price'],
            'property_size'   => $validated['property_size'] ?? '',
            'facing'          => $validated['facing'],
            'bhk_type'        => $validated['bhk_type'],
            'bathrooms'       => $validated['bathrooms'],
            'property_status' => $validated['property_status'],
            'furnishing_type' => $validated['furnishing_type'],
            'parking_type'    => $validated['parking_type'],
            'city'            => $validated['city'],
            'city_slug'       => $city->city_slug ?? '',
            'location'        => $validated['location'],
            'location_slug'   => $location->location_slug ?? '',
            'property_slug'   => $slug,
            'seo_url'         => $slug,
            'status'          => $validated['status'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/frontend/images/properyimages'), $filename);
                PropertyImage::create([
                    'property_id'    => $property->id,
                    'property_image' => 'assets/frontend/images/properyimages/' . $filename,
                    'created_date'   => now(),
                ]);
            }
        }

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully!');
    }

    public function edit(Property $property)
    {
        $cities = City::all();
        $locations = Location::all();
        $propertyTypes = PropertyType::all();
        $bhkTypes = BhkType::all();
        $propertyStatuses = PropertyStatus::all();
        $facings = Facing::all();
        $furnishings = Furnishing::all();
        $parkings = Parking::all();

        return view('admin.properties.edit', compact(
            'property',
            'cities',
            'locations',
            'propertyTypes',
            'bhkTypes',
            'propertyStatuses',
            'facings',
            'furnishings',
            'parkings'
        ));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'property_title'  => 'required|string|max:255',
            'property_type'   => 'required|integer',
            'property_desc'   => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'property_size'   => 'nullable|string|max:255',
            'facing'          => 'nullable|integer',
            'bhk_type'        => 'nullable|integer',
            'bathrooms'       => 'nullable|integer',
            'property_status' => 'nullable|integer',
            'furnishing_type' => 'nullable|integer',
            'parking_type'    => 'nullable|integer',
            'city'            => 'required|integer',
            'location'        => 'required|integer',
            'status'          => 'required|integer',
            'images.*'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $city = City::find($validated['city']);
        $location = Location::find($validated['location']);

        $property->update([
            'property_title'  => $validated['property_title'],
            'property_type'   => $validated['property_type'],
            'property_desc'   => $validated['property_desc'] ?? '',
            'price'           => $validated['price'],
            'property_size'   => $validated['property_size'] ?? '',
            'facing'          => $validated['facing'],
            'bhk_type'        => $validated['bhk_type'],
            'bathrooms'       => $validated['bathrooms'],
            'property_status' => $validated['property_status'],
            'furnishing_type' => $validated['furnishing_type'],
            'parking_type'    => $validated['parking_type'],
            'city'            => $validated['city'],
            'city_slug'       => $city->city_slug ?? '',
            'location'        => $validated['location'],
            'location_slug'   => $location->location_slug ?? '',
            'status'          => $validated['status'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/frontend/images/properyimages'), $filename);
                PropertyImage::create([
                    'property_id'    => $property->id,
                    'property_image' => 'assets/frontend/images/properyimages/' . $filename,
                    'created_date'   => now(),
                ]);
            }
        }

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully!');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully!');
    }
}
