<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityLocationController extends Controller
{
    public function index()
    {
        $cities = City::with('locations')->get();
        $locations = Location::with('cityRelation')->paginate(20);

        return view('admin.cities_locations', compact('cities', 'locations'));
    }

    public function storeCity(Request $request)
    {
        $request->validate([
            'city_name' => 'required|string|max:255|unique:cities,city_name',
        ]);

        City::create([
            'city_name' => $request->city_name,
            'city_slug' => Str::slug($request->city_name),
        ]);

        return back()->with('success', 'City added successfully!');
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'city_id'       => 'required|integer|exists:cities,id',
        ]);

        $city = City::findOrFail($request->city_id);

        Location::create([
            'location_name' => $request->location_name,
            'city_id'       => $city->id,
            'city_slug'     => $city->city_slug,
            'location_slug' => Str::slug($request->location_name),
        ]);

        return back()->with('success', 'Location added successfully!');
    }
}
