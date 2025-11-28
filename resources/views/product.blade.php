@extends('layout')

{{-- Bơm dữ liệu SEO lên layout cha --}}
@section('title', $meta_title)
@section('desc', $meta_desc)
@section('image', $product->image_url)

@section('schema')
    @if(isset($schema_json))
        <script type="application/ld+json">
            {!! $schema_json !!}
        </script>
    @endif
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        {{-- Thẻ H1 trùng với tiêu đề SEO là tín hiệu tốt --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
        
        <p class="text-2xl text-green-600 font-bold mb-4">
            {{ number_format($product->price) }} đ
        </p>

        <div class="prose max-w-none text-gray-600">
            {{ $product->description }}
        </div>
        
        <div class="mt-8 pt-4 border-t text-sm text-gray-400">
            <p>Slug hiện tại: {{ request()->path() }}</p>
            <p>Meta Description: {{ $meta_desc }}</p>
        </div>
    </div>
@endsection