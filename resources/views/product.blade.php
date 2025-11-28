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
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-[500px] object-cover transition duration-500 group-hover:scale-105">
            <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur text-white px-4 py-2 rounded-lg text-sm">
                Ảnh tối ưu Alt tag: "{{ $product->name }}"
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

            {{-- Box thông tin SEO --}}
            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 text-sm space-y-2 mt-8">
                <p class="font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path></svg>
                    Dữ liệu phân tích SEO:
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-500">
                    <div>
                        <span class="block text-xs uppercase text-gray-400 font-bold">URL Slug</span>
                        <code class="text-pink-600 bg-pink-50 px-1 rounded">{{ request()->path() }}</code>
                    </div>
                    <div>
                        <span class="block text-xs uppercase text-gray-400 font-bold">Meta Desc Length</span>
                        <span class="{{ strlen($meta_desc) > 160 ? 'text-red-500' : 'text-green-600' }}">
                            {{ strlen($meta_desc) }} ký tự (Chuẩn < 160)
                        </span>
                    </div>
                </div>
                <div class="mt-2 text-xs text-gray-400 italic bg-white p-2 rounded border border-dashed border-gray-300">
                    Meta Description: {{ $meta_desc }}
                </div>
            </div>
            
            <button class="w-full bg-green-600 text-white font-bold text-lg py-4 rounded-xl shadow-lg hover:bg-green-700 hover:shadow-green-300 transition transform hover:-translate-y-1">
                Đặt Ngay (Demo Button)
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