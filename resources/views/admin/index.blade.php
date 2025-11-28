@extends('layout')
@section('title', 'Quản trị hệ thống')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Quản lý Sản Phẩm</h1>
            <p class="text-gray-500 mt-1">Tổng quan danh sách các món uống hiện có</p>
        </div>
        <a href="{{ route('admin.create') }}" 
           class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-green-200 transition transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Thêm món mới
        </a>
    </div>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm mb-6 flex items-center justify-between animate-fade-in-down">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.style.display='none'" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="p-5">Tên món</th>
                        <th class="p-5">Giá niêm yết</th>
                        <th class="p-5">Slug (SEO URL)</th>
                        <th class="p-5 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-150 group">
                        <td class="p-5">
                            <div class="font-bold text-gray-900">{{ $product->name }}</div>
                        </td>
                        <td class="p-5">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                {{ number_format($product->price) }} đ
                            </span>
                        </td>
                        <td class="p-5 text-gray-500 text-sm font-mono">
                            /menu/<span class="text-gray-700 font-medium">{{ $product->slug }}</span>
                        </td>
                        <td class="p-5">
                            <div class="flex justify-center gap-3">
                                {{-- Nút Sửa --}}
                                <a href="{{ route('admin.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Sửa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                {{-- Nút Xóa --}}
                                <a href="{{ route('admin.delete', $product->id) }}" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" onclick="return confirm('Bạn có chắc chắn muốn xóa món này không? Hành động này không thể hoàn tác!')" title="Xóa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Empty State (Nếu chưa có dữ liệu) --}}
        @if(count($products) == 0)
            <div class="p-12 text-center text-gray-400">
                <p class="text-lg">Chưa có sản phẩm nào.</p>
                <p class="text-sm">Hãy thêm món đầu tiên ngay!</p>
            </div>
        @endif
    </div>
</div>
@endsection