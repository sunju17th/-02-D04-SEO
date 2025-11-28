@extends('layout')
@section('title', 'Cập nhật: ' . $product->name)

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Breadcrumb (Nút quay lại) --}}
    <div class="mb-6 flex items-center text-sm text-gray-500">
        <a href="{{ route('admin.index') }}" class="hover:text-green-600 flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Hủy bỏ & Quay lại danh sách
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <div class="border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Chỉnh Sửa Sản Phẩm</h2>
            <p class="text-gray-500 text-sm mt-1">Đang cập nhật: <span class="font-bold text-green-600">{{ $product->name }}</span></p>
        </div>
        
        <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT') {{-- Bắt buộc để Laravel hiểu là update --}}
            
            {{-- Tên món --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tên món <span class="text-red-500">*</span></label>
                <input type="text" name="name" 
                       value="{{ old('name', $product->name) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 transition shadow-sm @error('name') border-red-500 @enderror" 
                       required
                       placeholder="Nhập tên món mới..."
                       onkeyup="updateSeoPreview(this.value, 'title')">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grid: Giá & Ảnh --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Giá --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Giá tiền (VNĐ) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" name="price" 
                               value="{{ old('price', $product->price) }}"
                               class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 pl-4 @error('price') border-red-500 @enderror" 
                               required>
                        <span class="absolute right-4 top-3 text-gray-400 font-bold">đ</span>
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ảnh (Preview + Input) --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Ảnh sản phẩm</label>
                    <div class="flex items-start gap-4">
                        {{-- Ảnh Preview --}}
                        <div class="shrink-0 relative group">
                            <img id="preview-img" 
                                 src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" 
                                 class="h-24 w-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                            <div class="absolute inset-0 bg-black/10 rounded-xl"></div>
                        </div>

                        {{-- Input File --}}
                        <div class="flex-1">
                            <input type="file" name="image" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer"
                                   accept="image/*" 
                                   onchange="document.getElementById('preview-img').src = window.URL.createObjectURL(this.files[0])">
                            <p class="text-xs text-gray-400 mt-2">Chỉ chọn ảnh nếu bạn muốn thay đổi ảnh hiện tại.</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Mô tả --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Mô tả chi tiết <span class="text-red-500">*</span></label>
                <textarea name="description" rows="5" 
                          class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 transition shadow-sm @error('description') border-red-500 @enderror" 
                          required
                          onkeyup="updateSeoPreview(this.value, 'desc')">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- SEO Section (Box xanh) --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold uppercase">SEO Config</span>
                    <label class="text-blue-900 font-bold">Cập nhật hiển thị Google</label>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600 font-medium block mb-1">Meta Description</label>
                        <input type="text" name="meta_description" 
                               value="{{ old('meta_description', $product->meta_description) }}"
                               id="meta_input"
                               class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm bg-white" 
                               onkeyup="document.getElementById('seo-desc-preview').innerText = this.value">
                    </div>

                    {{-- Live Preview --}}
                    <div class="bg-white p-3 rounded border border-gray-200 shadow-sm text-sm">
                        <p class="text-xs text-gray-400 mb-1">Xem trước:</p>
                        <p class="text-blue-800 font-medium text-lg truncate hover:underline cursor-pointer" id="seo-title-preview">
                            {{ $product->name }}
                        </p>
                        <p class="text-green-700 text-xs mb-1">{{ url('/') }}/menu/<span class="text-gray-900 font-bold">{{ $product->slug }}</span></p>
                        <p class="text-gray-600 text-xs line-clamp-2" id="seo-desc-preview">
                            {{ $product->meta_description ? $product->meta_description : \Illuminate\Support\Str::limit($product->description, 150) }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-xl shadow-lg hover:bg-blue-700 hover:shadow-blue-300 transition transform hover:-translate-y-1">
                    Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script nhỏ để cập nhật SEO Preview --}}
<script>
    function updateSeoPreview(val, type) {
        if (type === 'title') {
            document.getElementById('seo-title-preview').innerText = val;
        }
        // Chỉ cập nhật mô tả preview nếu ô Meta Description đang trống
        if (type === 'desc') {
            const metaInput = document.getElementById('meta_input');
            if (!metaInput.value) {
                document.getElementById('seo-desc-preview').innerText = val.substring(0, 150) + '...';
            }
        }
    }
</script>
@endsection