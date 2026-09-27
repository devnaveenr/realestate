@extends('layouts.admin')

@section('title', 'Manage Cities & Locations - Admin')
@section('page_title', 'Cities & Localities Directory')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Left: Cities -->
        <div class="space-y-6">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-4">
                <h3 class="font-bold text-white text-base">Add New City</h3>
                <form action="{{ route('admin.cities.store') }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="text" name="city_name" required placeholder="e.g. Chennai" class="flex-grow bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-amber-400">
                    <button type="submit" class="px-5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs shrink-0">
                        Add City
                    </button>
                </form>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="px-6 py-4 border-b border-slate-800">
                    <h3 class="font-bold text-white text-base">Existing Cities</h3>
                </div>
                <div class="divide-y divide-slate-800">
                    @foreach($cities as $city)
                        <div class="px-6 py-3.5 flex items-center justify-between">
                            <div>
                                <span class="font-bold text-white text-sm block">{{ $city->city_name }}</span>
                                <span class="text-xs text-slate-500">Slug: {{ $city->city_slug }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 text-xs font-semibold mr-1">
                                    {{ $city->locations->count() }} Localities
                                </span>
                                <button type="button" onclick="toggleElement('edit-city-{{ $city->id }}')" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-amber-400 text-xs transition" title="Edit City">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this city and all its localities?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs transition" title="Delete City">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Edit City Collapsible Form -->
                        <div id="edit-city-{{ $city->id }}" class="hidden px-6 py-3 bg-slate-950/70 border-t border-b border-slate-800">
                            <form action="{{ route('admin.cities.update', $city->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="city_name" value="{{ $city->city_name }}" required class="flex-grow bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none focus:border-amber-400">
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs shrink-0">
                                    Save
                                </button>
                                <button type="button" onclick="toggleElement('edit-city-{{ $city->id }}')" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs shrink-0">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Locations -->
        <div class="space-y-6">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-4">
                <h3 class="font-bold text-white text-base">Add New Locality / Area</h3>
                <form action="{{ route('admin.locations.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <select name="city_id" required class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-amber-400">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="location_name" required placeholder="e.g. Gachibowli" class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs">
                        Add Location
                    </button>
                </form>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="px-6 py-4 border-b border-slate-800">
                    <h3 class="font-bold text-white text-base">All Localities</h3>
                </div>
                <div class="divide-y divide-slate-800">
                    @foreach($locations as $loc)
                        <div class="px-6 py-3.5 flex items-center justify-between text-sm">
                            <div>
                                <span class="font-semibold text-white block">{{ $loc->location_name }}</span>
                                <span class="text-xs text-slate-500">Slug: {{ $loc->location_slug }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-amber-400 bg-amber-500/10 px-2.5 py-0.5 rounded-md border border-amber-500/20 mr-1">
                                    {{ $loc->cityRelation->city_name ?? 'N/A' }}
                                </span>
                                <button type="button" onclick="toggleElement('edit-loc-{{ $loc->id }}')" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-amber-400 text-xs transition" title="Edit Locality">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('admin.locations.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this locality?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs transition" title="Delete Locality">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Location Collapsible Form -->
                        <div id="edit-loc-{{ $loc->id }}" class="hidden px-6 py-3 bg-slate-950/70 border-t border-b border-slate-800">
                            <form action="{{ route('admin.locations.update', $loc->id) }}" method="POST" class="space-y-2">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <select name="city_id" required class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none focus:border-amber-400">
                                        @foreach($cities as $c)
                                            <option value="{{ $c->id }}" {{ $loc->city_id == $c->id ? 'selected' : '' }}>{{ $c->city_name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="location_name" value="{{ $loc->location_name }}" required class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none focus:border-amber-400">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="toggleElement('edit-loc-{{ $loc->id }}')" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs">
                                        Cancel
                                    </button>
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 border-t border-slate-800">
                    {{ $locations->links() }}
                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleElement(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.toggle('hidden');
            }
        }
    </script>

@endsection
