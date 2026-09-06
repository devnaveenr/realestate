@extends('layouts.admin')

@section('title', 'Admin Dashboard - RealEstate')
@section('page_title', 'Dashboard Metrics')

@section('content')

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Metric 1: Total Properties -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Total Properties</span>
                <span class="text-3xl font-extrabold text-white mt-1 block">{{ $totalProperties }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-building"></i>
            </div>
        </div>

        <!-- Metric 2: Active Properties -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Active Listings</span>
                <span class="text-3xl font-extrabold text-emerald-400 mt-1 block">{{ $activeProperties }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Metric 3: Cities & Locations -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Cities / Localities</span>
                <span class="text-3xl font-extrabold text-white mt-1 block">{{ $totalCities }} / {{ $totalLocations }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
        </div>

        <!-- Metric 4: Customer Inquiries -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Buyer Inquiries</span>
                <span class="text-3xl font-extrabold text-amber-400 mt-1 block">{{ $totalInquiries }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>

    </div>

    <!-- Content Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Inquiries -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="font-bold text-white text-base flex items-center gap-2">
                    <i class="fa-solid fa-envelope text-amber-400"></i> Recent Inquiries
                </h3>
                <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-amber-400 hover:underline">View All</a>
            </div>

            <div class="space-y-3">
                @forelse($recentInquiries as $inquiry)
                    <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-white text-sm">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</span>
                                <span class="text-[10px] text-slate-400">({{ $inquiry->phone }})</span>
                            </div>
                            <p class="text-xs text-amber-400 mt-0.5">Property: {{ $inquiry->property->property_title ?? 'General Inquiry' }}</p>
                            <p class="text-xs text-slate-300 mt-2 line-clamp-1">"{{ $inquiry->message }}"</p>
                        </div>
                        <span class="text-[10px] text-slate-500 shrink-0">{{ $inquiry->created_at ? $inquiry->created_at->diffForHumans() : '' }}</span>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-6">No buyer inquiries received yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Properties -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="font-bold text-white text-base flex items-center gap-2">
                    <i class="fa-solid fa-building text-amber-400"></i> Recently Added Properties
                </h3>
                <a href="{{ route('admin.properties.index') }}" class="text-xs text-amber-400 hover:underline">Manage All</a>
            </div>

            <div class="space-y-3">
                @forelse($recentProperties as $prop)
                    <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 flex items-center justify-between gap-4">
                        <div class="truncate">
                            <span class="font-bold text-white text-sm truncate block">{{ $prop->property_title }}</span>
                            <span class="text-xs text-slate-400">{{ $prop->locationRelation->location_name ?? '' }}, {{ $prop->cityRelation->city_name ?? '' }}</span>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="text-xs font-bold text-amber-400 block">₹{{ number_format($prop->price) }}</span>
                            <a href="{{ route('admin.properties.edit', $prop->id) }}" class="text-[11px] text-slate-400 hover:text-white">Edit</a>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-6">No properties listed yet.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection
