<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - RealEstate')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex flex-col md:flex-row antialiased">

    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-slate-900 border-r border-slate-800 flex flex-col shrink-0">
        <div class="h-20 flex items-center px-6 border-b border-slate-800 justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-extrabold text-lg">
                    <i class="fa-solid fa-city"></i>
                </div>
                <span class="font-bold text-lg text-white">Admin<span class="text-amber-400">Panel</span></span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="text-xs text-slate-400 hover:text-amber-400 flex items-center gap-1" title="View Site">
                <i class="fa-solid fa-external-link"></i>
            </a>
        </div>

        <nav class="flex-grow p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800' }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>
            <a href="{{ route('admin.properties.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.properties.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800' }}">
                <i class="fa-solid fa-building font-semibold"></i> Properties
            </a>
            <a href="{{ route('admin.cities.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.cities.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800' }}">
                <i class="fa-solid fa-map-location-dot"></i> Cities & Locations
            </a>
            <a href="{{ route('admin.inquiries.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.inquiries.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800' }}">
                <i class="fa-solid fa-envelope-open-text"></i> Inquiries
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800' }}">
                <i class="fa-solid fa-sliders"></i> Settings & Sliders
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-amber-400 font-bold text-xs">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-xs">
                        <p class="font-semibold text-white leading-none">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <p class="text-slate-400 text-[10px]">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-400 transition" title="Logout">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Top Navbar -->
        <header class="h-20 bg-slate-900/60 border-b border-slate-800 px-8 flex items-center justify-between">
            <h1 class="text-lg font-bold text-white">@yield('page_title', 'Dashboard Overview')</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.properties.create') }}" class="px-4 py-2 rounded-xl bg-amber-500 text-slate-950 font-bold text-xs flex items-center gap-2 hover:bg-amber-400 transition">
                    <i class="fa-solid fa-plus"></i> Add Property
                </a>
            </div>
        </header>

        <!-- Main Body -->
        <main class="p-6 md:p-8 flex-grow">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center gap-3 text-sm">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
