@extends('layouts.admin')

@section('title', 'Add New Property - Admin')
@section('page_title', 'Create Property Listing')

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-white">New Property Form</h2>
            <a href="{{ route('admin.properties.index') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Back to Properties
            </a>
        </div>

        <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-2xl p-8 space-y-6 shadow-xl">
            @csrf

            <!-- Section 1: Basic Info -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider border-b border-slate-800 pb-2">1. General Information</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Property Title *</label>
                    <input type="text" name="property_title" required placeholder="e.g. 3 BHK Luxury Apartment in Madhapur" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Price (in ₹) *</label>
                        <input type="number" step="0.01" name="price" required placeholder="e.g. 7500000" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Super Area Size</label>
                        <input type="text" name="property_size" placeholder="e.g. 1850 Sqft" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Listing Status *</label>
                        <select name="status" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                            <option value="1">Active / Published</option>
                            <option value="0">Inactive / Draft</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 2: Location & Type -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider border-b border-slate-800 pb-2">2. Location & Property Type</h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">City *</label>
                        <select name="city" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Location / Area *</label>
                        <select name="location" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Property Type *</label>
                        <select name="property_type" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                            @foreach($propertyTypes as $type)
                                <option value="{{ $type->id }}">{{ trim($type->property_type) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 3: Specifications -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider border-b border-slate-800 pb-2">3. Specifications & Attributes</h3>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">BHK Type</label>
                        <select name="bhk_type" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                            <option value="">Select</option>
                            @foreach($bhkTypes as $bhk)
                                <option value="{{ $bhk->id }}">{{ $bhk->bhk_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Bathrooms</label>
                        <input type="number" name="bathrooms" placeholder="2" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Facing</label>
                        <select name="facing" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                            <option value="">Select</option>
                            @foreach($facings as $facing)
                                <option value="{{ $facing->id }}">{{ $facing->facing_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Furnishing</label>
                        <select name="furnishing_type" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                            <option value="">Select</option>
                            @foreach($furnishings as $f)
                                <option value="{{ $f->id }}">{{ $f->furnishing_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Parking</label>
                        <select name="parking_type" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                            <option value="">Select</option>
                            @foreach($parkings as $p)
                                <option value="{{ $p->id }}">{{ $p->parking_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Status</label>
                        <select name="property_status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                            <option value="">Select</option>
                            @foreach($propertyStatuses as $ps)
                                <option value="{{ $ps->id }}">{{ trim($ps->property_status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 4: Description & Photos -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider border-b border-slate-800 pb-2">4. Description & Photos</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</label>
                    <textarea name="property_desc" rows="4" placeholder="Write property features, amenities, landmark references..." class="w-full bg-slate-950 border border-slate-800 rounded-xl p-4 text-sm text-white focus:outline-none focus:border-amber-400"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Upload Property Photos</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full bg-slate-950 border border-slate-800 rounded-xl p-2.5 text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-400 cursor-pointer">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-extrabold text-sm shadow-lg shadow-amber-500/20 transition">
                Create & Publish Property Listing
            </button>

        </form>

    </div>

@endsection
