<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Import thư viện để xóa ảnh cũ nếu cần

class AdminProductController extends Controller
{
    // 1. Danh sách sản phẩm
    public function index() {
        $products = Product::latest()->get();
        return view('admin.index', compact('products'));
    }

    // 2. Form thêm mới
    public function create() {
        return view('admin.create');
    }

    // 3. Lưu sản phẩm mới (Create)
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:160'
        ]);

        $data = $request->all();
        
        // Tạo Slug & Meta
        $data['slug'] = Str::slug($request->name);
        
        if ($request->filled('meta_description')) {
            $data['meta_description'] = $request->meta_description;
        } else {
            $data['meta_description'] = Str::limit($request->description, 150);
        }

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $data['slug'] . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        // --- QUAN TRỌNG: Xóa trường 'image' thừa để tránh lỗi SQL ---
        unset($data['image']); 

        Product::create($data);

        return redirect()->route('admin.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    // 4. Form sửa
    public function edit($id) {
        $product = Product::findOrFail($id); 
        return view('admin.edit', compact('product'));
    }

    // 5. Cập nhật (Update)
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:160'
        ]);

        $data = $request->all();

        // Cập nhật Slug nếu đổi tên
        if ($product->name != $request->name) {
            $data['slug'] = Str::slug($request->name);
        }

        // Logic Meta Description
        if (!$request->filled('meta_description')) {
            $data['meta_description'] = Str::limit($request->description, 150);
        }

        // XỬ LÝ ẢNH KHI SỬA
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // Đặt tên file theo slug (ưu tiên slug mới nếu có, không thì dùng slug cũ)
            $slugName = isset($data['slug']) ? $data['slug'] : $product->slug;
            $filename = $slugName . '-' . time() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('products', $filename, 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        // --- QUAN TRỌNG: Xóa trường 'image' thừa ---
        unset($data['image']); 

        $product->update($data);

        return redirect()->route('admin.index')->with('success', 'Đã cập nhật món ' . $product->name);
    }

    // 6. Xóa (Delete)
    public function destroy($id) {
        Product::destroy($id);
        return redirect()->route('admin.index')->with('success', 'Đã xóa món!');
    }
}