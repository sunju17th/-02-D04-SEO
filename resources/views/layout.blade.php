<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'DrinkStore - Thức uống ngon')</title>
    <meta name="description" content="@yield('desc', 'Hương vị tuyệt vời trong từng ly nước')">
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('desc')" />
    <meta property="og:image" content="@yield('image')" />

    @yield('schema')
    
    {{-- Tailwind CSS & Font --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Hiệu ứng kính mờ cho Navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    
    {{-- Navbar --}}
    <nav class="glass-nav fixed w-full z-50 transition-all duration-300 shadow-sm top-0">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <span class="bg-green-600 text-white p-2 rounded-lg text-xl shadow-lg group-hover:bg-green-700 transition">☕</span>
                <span class="font-bold text-2xl text-gray-800 tracking-tight">Drink<span class="text-green-600">Store</span></span>
            </a>
            
            {{-- Search Bar --}}
            <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center bg-gray-100 rounded-full px-4 py-2 border border-transparent focus-within:border-green-500 focus-within:bg-white focus-within:shadow-md transition-all w-1/3">
                <input type="text" name="q" placeholder="Bạn muốn uống gì hôm nay?..." class="bg-transparent border-none outline-none w-full text-sm text-gray-700 placeholder-gray-400">
                <button type="submit" class="text-gray-400 hover:text-green-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>

            {{-- Menu Links --}}
            <div class="flex items-center space-x-8 font-medium text-sm">
                <a href="{{ route('home') }}" class="transition hover:text-green-600 {{ request()->routeIs('home') ? 'text-green-600 font-bold' : 'text-gray-500' }}">Trang Chủ</a>
                <a href="{{ route('about') }}" class="transition hover:text-green-600 {{ request()->routeIs('about') ? 'text-green-600 font-bold' : 'text-gray-500' }}">Giới Thiệu</a>
                <a href="{{ route('admin.index') }}" class="bg-gray-900 text-white px-5 py-2.5 rounded-full hover:bg-gray-700 hover:shadow-lg transition transform hover:-translate-y-0.5 text-xs font-bold uppercase tracking-wider">
                    Admin Area
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow container mx-auto px-6 pt-28 pb-12">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t py-8 mt-auto">
        <div class="container mx-auto px-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} DrinkStore. SEO Demo Project using Laravel & Tailwind.
        </div>
    </footer>
</body>
</html>