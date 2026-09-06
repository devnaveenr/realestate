@extends('layouts.admin')

@section('title', 'Site Settings - Admin')
@section('page_title', 'Configuration & Sliders')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Site Settings Form -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-6 shadow-xl">
            <h3 class="font-bold text-white text-lg border-b border-slate-800 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-gear text-amber-400"></i> General Site Settings
            </h3>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Company / Site Name *</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name ?? 'Nag Solutions') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Contact Phone</label>
                        <input type="text" name="contact_no" value="{{ old('contact_no', $setting->contact_no ?? '8309694254') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Company Email</label>
                        <input type="email" name="company_email" value="{{ old('company_email', $setting->company_email ?? 'info@nag.com') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Address</label>
                    <textarea name="address" rows="3" class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm text-white focus:outline-none focus:border-amber-400">{{ old('address', strip_tags($setting->address ?? 'Hyderabad, India')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">USD Exchange Price Rate</label>
                    <input type="number" step="0.01" name="usd_price" value="{{ old('usd_price', $setting->usd_price ?? '83.50') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs">
                    Save Site Settings
                </button>
            </form>
        </div>

        <!-- Slider Banners Management -->
        <div class="space-y-6">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-4 shadow-xl">
                <h3 class="font-bold text-white text-lg border-b border-slate-800 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-images text-amber-400"></i> Upload New Slider Banner
                </h3>

                <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Banner Caption / Title</label>
                        <input type="text" name="slide_desc" placeholder="e.g. Find Luxury Homes in Hyderabad" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Banner Image File *</label>
                        <input type="file" name="slide_image" required accept="image/*" class="w-full bg-slate-950 border border-slate-800 rounded-xl p-2.5 text-xs text-slate-400 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-400 cursor-pointer">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs">
                        Upload Slide
                    </button>
                </form>
            </div>

            <!-- Existing Banners -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-4">
                <h4 class="font-bold text-white text-sm">Active Banners</h4>
                <div class="space-y-3">
                    @forelse($slides as $slide)
                        <div class="p-3 rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-12 rounded-lg bg-slate-900 overflow-hidden shrink-0 border border-slate-800">
                                    <img src="{{ asset($slide->slide_image) }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-white">{{ $slide->slide_desc ?: 'Banner #' . $slide->id }}</p>
                                </div>
                            </div>
                            <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Delete this banner?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-400 text-xs">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500 text-center py-4">No hero slides uploaded.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

@endsection
