@extends('layouts.admin')

@section('title', 'Manage Properties - Admin')
@section('page_title', 'All Listed Properties')

@section('content')

    <div class="space-y-6">
        
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-900 p-6 rounded-2xl border border-slate-800">
            <div>
                <h2 class="text-xl font-bold text-white">Property Management</h2>
                <p class="text-xs text-slate-400 mt-1">View, edit, toggle visibility or delete property listings</p>
            </div>
            <a href="{{ route('admin.properties.create') }}" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs flex items-center gap-2 transition self-start sm:self-auto">
                <i class="fa-solid fa-plus"></i> Add New Property
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-950 text-slate-400 text-xs uppercase tracking-wider border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">ID / Title</th>
                            <th class="px-6 py-4">Type & City</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($properties as $property)
                            <tr class="hover:bg-slate-800/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-800 overflow-hidden shrink-0 flex items-center justify-center text-slate-600">
                                            @if($property->images->first())
                                                <img src="{{ asset($property->images->first()->property_image) }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fa-solid fa-building"></i>
                                            @endif
                                        </div>
                                        <div class="max-w-md">
                                            <a href="{{ route('properties.show', $property->property_slug ?: $property->id) }}" target="_blank" class="font-bold text-white hover:text-amber-400 transition truncate block">
                                                {{ $property->property_title }}
                                            </a>
                                            <span class="text-xs text-slate-500">ID: #RE-{{ $property->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs">
                                        <span class="font-semibold text-slate-200 block">{{ trim($property->typeRelation->property_type ?? 'Property') }}</span>
                                        <span class="text-slate-400">{{ $property->locationRelation->location_name ?? '' }}, {{ $property->cityRelation->city_name ?? '' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-amber-400">
                                    ₹{{ number_format($property->price) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($property->status == 1)
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-semibold">Active</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-slate-800 text-slate-400 text-xs font-semibold">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.properties.edit', $property->id) }}" class="p-2 rounded-lg bg-slate-800 text-slate-300 hover:text-amber-400 hover:bg-slate-700 transition" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-slate-800 text-slate-400 hover:text-red-400 hover:bg-slate-700 transition" title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    No properties found. Click "Add New Property" to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-800">
                {{ $properties->links() }}
            </div>
        </div>

    </div>

@endsection
