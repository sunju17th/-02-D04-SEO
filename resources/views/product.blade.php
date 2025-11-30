@extends('layout')

@section('title', $meta_title)
@section('desc', $meta_desc)
@section('image', $product->image_url)

@section('schema')
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org/",
            "@@type": "Product",
            "name": "{{ $product->name }}",
            "image": [
                "{{ asset($product->image_url) }}" 
            ],
            "description": {!! json_encode($product->meta_description ?? $product->description, JSON_UNESCAPED_UNICODE) !!},
            "sku": "DRINK-{{ $product->id }}",
            "brand": {
                "@@type": "Brand",
                "name": "DrinkStore"
            },
            "offers": {
                "@@type": "Offer",
                "url": "{{ route('product.detail', $product->slug) }}",
                "priceCurrency": "VND",
                "price": "{{ $product->price }}",
                "availability": "https://schema.org/InStock",
                "itemCondition": "https://schema.org/NewCondition"
            }
        }
        </script>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start mb-16">
        
        {{-- Cột trái: Ảnh --}}
        <div class="rounded-3xl overflow-hidden shadow-2xl border border-gray-100 relative group">
            <img 
                src="{{ $product->image_url }}" 
                alt="{{ $product->name }} - DrinkStore" 
                class="w-full h-[500px] object-cover transition duration-500 group-hover:scale-105"
                loading="lazy"
            >
            <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur text-white px-4 py-2 rounded-lg text-sm">
                "{{ $product->name }}"
            </div>
        </div>

        {{-- Cột phải: Thông tin --}}
        <div class="space-y-6 lg:pt-8">
            <div class="flex items-center gap-2 text-sm font-medium text-green-600 mb-2">
                <span class="bg-green-100 px-3 py-1 rounded-full">Đồ uống Best Seller</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">{{ $product->name }}</h1>
            
            <p class="text-3xl text-green-600 font-bold">
                {{ number_format($product->price) }} đ
            </p>

            <div class="prose prose-lg text-gray-600 border-t border-b py-6 border-gray-100">
                {{ $product->description }}
            </div>

            
            
            <button class="w-full bg-green-600 text-white font-bold text-lg py-4 rounded-xl shadow-lg hover:bg-green-700 hover:shadow-green-300 transition transform hover:-translate-y-1">
                Đặt Ngay
            </button>
        </div>
    </div>

    {{-- Sản phẩm liên quan --}}
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
    <div class="border-t pt-16 mt-16">
        <h3 class="text-2xl font-bold mb-8 text-gray-900 text-center">Có thể bạn cũng thích</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $item)
                <a href="{{ route('product.detail', $item->slug) }}" class="group block bg-white rounded-xl shadow hover:shadow-lg transition border border-gray-100 overflow-hidden">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $item->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-4">
                        <p class="font-bold text-gray-800 text-lg mb-1 truncate group-hover:text-green-600 transition">{{ $item->name }}</p>
                        <span class="text-green-600 font-bold text-sm">{{ number_format($item->price) }} đ</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

@endsection