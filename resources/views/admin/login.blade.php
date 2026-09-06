<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - RealEstate</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-md bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-amber-500 text-slate-950 flex items-center justify-center font-extrabold text-2xl mx-auto shadow-lg shadow-amber-500/20">
                <i class="fa-solid fa-city"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-white">Admin Portal</h1>
            <p class="text-xs text-slate-400">Sign in to manage properties & customer inquiries</p>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3.5 top-3 text-slate-500"></i>
                    <input type="email" name="email" value="{{ old('email', 'admin@example.com') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3.5 top-3 text-slate-500"></i>
                    <input type="password" name="password" value="password123" required class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-slate-400 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded bg-slate-950 border-slate-800 text-amber-500 focus:ring-0">
                    <span>Remember Me</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-extrabold text-sm shadow-lg shadow-amber-500/20 transition">
                Sign In To Dashboard
            </button>
        </form>

        <div class="text-center pt-2 border-t border-slate-800 text-xs text-slate-500">
            Default credentials: <span class="text-slate-300">admin@example.com</span> / <span class="text-slate-300">password123</span>
        </div>

    </div>

</body>
</html>
