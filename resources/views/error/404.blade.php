@extends('layout')
@section('title', 'Không tìm thấy trang')

@section('content')
<div class="text-center py-20">
    <h1 class="text-9xl font-bold text-gray-200">404</h1>
    <p class="text-2xl font-bold text-gray-800 mb-4">Ối! Đồ uống này chưa được pha chế.</p>
    <p class="text-gray-600 mb-8">Trang bạn tìm không tồn tại hoặc đã bị xóa.</p>
    
    <a href="{{ route('home') }}" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition">
        Quay về thực đơn
    </a>
</div>
@endsection