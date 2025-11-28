@extends('layout')

@section('title', $meta_title)
@section('desc', $meta_desc)

@section('content')
    {{-- Hero Section nhỏ --}}
    <div class="text-center mb-16 max-w-2xl mx-auto">
        <span class="text-green-600 font-bold tracking-wider uppercase text-sm bg-green-100 px-3 py-1 rounded-full">Menu Hôm Nay</span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 mb-6 leading-tight">Thưởng thức hương vị <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-500">Tuyệt Hảo Nhất</span></h1>
        <p class="text-gray-500 text-lg">Chọn món uống yêu thích của bạn và trải nghiệm demo kỹ thuật SEO On-page trực quan.</p>
    </div>

    {{-- Grid Sản phẩm --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        
        @foreach($products as $product)
            <div class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col h-full overflow-hidden hover:-translate-y-2 relative">
                
                {{-- Ảnh sản phẩm với hiệu ứng zoom --}}
                <div class="h-64 overflow-hidden relative bg-gray-100">
                     <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
                     <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full shadow-sm text-gray-800">
                         Mới
                     </div>
                </div>
                
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-3">
                        <h2 class="text-xl font-bold text-gray-800 group-hover:text-green-600 transition line-clamp-1">{{ $product->name }}</h2>
                        <span class="text-green-600 font-bold text-lg whitespace-nowrap">{{ number_format($product->price) }} đ</span>
                    </div>
                    
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 leading-relaxed flex-grow">
                        {{ $product->description }}
                    </p>

                    <a href="{{ route('product.detail', $product->slug) }}" 
                       class="block w-full text-center bg-gray-900 text-white font-medium py-3 rounded-xl hover:bg-green-600 shadow-lg shadow-gray-200 hover:shadow-green-200 transition-all duration-300">
                        Xem & Phân Tích SEO
                    </a>
                </div>
            </div>
        @endforeach

    </div>
    
    {{-- Technical Note --}}
    <div class="mt-20 p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-200 rounded-full opacity-20 blur-xl"></div>
        <div class="relative z-10 flex gap-4 items-start">
            <div class="bg-blue-600 text-white p-3 rounded-lg shadow-md shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-blue-900 text-lg">Góc kỹ thuật (Technical Note):</h3>
                <p class="text-blue-800 mt-2 leading-relaxed">
                    Tại trang chủ này, hệ thống đang thực hiện kỹ thuật <strong>Internal Linking</strong>. 
                    Các thẻ <code>&lt;a href="..."&gt;</code> được tối ưu để Google Bot dễ dàng "crawling" (thu thập dữ liệu) từ trang chủ vào các trang con (Silo structure).
                </p>
            </div>
        </div>
    </div>
@endsection