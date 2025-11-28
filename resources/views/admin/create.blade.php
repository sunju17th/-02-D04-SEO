@extends('layout')
@section('title', 'Thêm món mới')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Breadcrumb nhỏ --}}
    <div class="mb-6 flex items-center text-sm text-gray-500">
        <a href="{{ route('admin.index') }}" class="hover:text-green-600 flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Quay lại danh sách
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 border-b pb-4">Thêm Sản Phẩm Mới</h2>
        
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf 
            
            {{-- Tên món --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tên món uống <span class="text-red-500">*</span></label>
                <input type="text" name="name" 
                       class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition shadow-sm" 
                       required placeholder="VD: Trà Đào Cam Sả"
                       onkeyup="document.getElementById('seo-preview').innerText = this.value">
            </div>

            {{-- Giá & Ảnh (Grid 2 cột) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Giá tiền (VNĐ) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" name="price" 
                               class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 transition shadow-sm pl-4" 
                               required placeholder="0">
                        <span class="absolute right-4 top-3 text-gray-400 font-bold">đ</span>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Ảnh sản phẩm <span class="text-red-500">*</span></label>
                    <input type="file" name="image" 
                           class="w-full border border-gray-300 p-2.5 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition cursor-pointer file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200" 
                           accept="image/*" required>
                </div>
            </div>

            {{-- Mô tả --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Mô tả chi tiết <span class="text-red-500">*</span></label>
                <textarea name="description" rows="5" 
                          class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 transition shadow-sm" 
                          required placeholder="Viết gì đó hấp dẫn về món uống này..."></textarea>
            </div>

            {{-- SEO Section --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold uppercase">SEO Advanced</span>
                    <label class="text-blue-900 font-bold">Cấu hình hiển thị Google</label>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600 font-medium block mb-1">Meta Description (Tùy chọn)</label>
                        <input type="text" name="meta_description" 
                               class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm bg-white" 
                               placeholder="Viết ngắn gọn để hiển thị trên Google (tối đa 160 ký tự)...">
                    </div>
                    
                    {{-- Preview giả lập Google --}}
                    <div class="bg-white p-3 rounded border border-gray-200 shadow-sm text-sm">
                        <p class="text-xs text-gray-400 mb-1">Xem trước kết quả tìm kiếm:</p>
                        <p class="text-blue-800 font-medium text-lg truncate hover:underline cursor-pointer" id="seo-preview">Tiêu đề sản phẩm sẽ hiện ở đây...</p>
                        <p class="text-green-700 text-xs mb-1">{{ url('/') }}/menu/...</p>
                        <p class="text-gray-600 text-xs line-clamp-2">Mô tả sản phẩm hoặc Meta Description sẽ hiển thị ở đây giúp thu hút người dùng click vào trang web của bạn.</p>
                    </div>

                    <p class="text-xs text-blue-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Nếu để trống, hệ thống sẽ tự động lấy 150 ký tự đầu của mô tả chi tiết.
                    </p>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-green-600 hover:shadow-green-300 transition-all duration-300 transform hover:-translate-y-1 text-lg">
                Lưu Sản Phẩm & Tự Động SEO
            </button>
        </form>
    </div>
</div>
@endsection