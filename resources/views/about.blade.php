@extends('layout')
@section('title', $meta_title)
@section('desc', $meta_desc)

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow text-center">
        <h1 class="text-3xl font-bold mb-4">Câu Chuyện Của Chúng Tôi</h1>
        <p class="text-gray-600 leading-relaxed mb-6">
            Chào mừng bạn đến với DrinkStore. Chúng tôi bắt đầu với niềm đam mê mãnh liệt về cà phê và trà sữa...
            (Bạn có thể chém gió thêm phần này cho dài).
        </p>
        <img src="https://via.placeholder.com/800x400?text=Our+Team" class="rounded w-full mb-4">
    </div>
@endsection