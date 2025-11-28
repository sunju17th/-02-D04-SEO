<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO ĐỘNG: Thay đổi theo từng trang --}}
    <title>@yield('title', 'Mặc định')</title>
    <meta name="description" content="@yield('desc', 'Mô tả mặc định')">

    {{-- Canonical: Tránh lỗi trùng lặp nội dung --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph: Để share lên Facebook đẹp --}}
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('desc')" />
    <meta property="og:image" content="@yield('image')" />

    {{-- Schema JSON-LD --}}
    @yield('schema')
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto">
            <a href="/" class="font-bold text-xl text-green-600">DrinkStore</a>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>