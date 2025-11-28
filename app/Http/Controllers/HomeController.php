<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Trang chủ
    public function index() {
        // 1. Lấy tất cả sản phẩm từ database
        $products = Product::all();

        // 2. Trả về view 'home' kèm biến $products
        return view('home', [
            'products' => $products,
            'meta_title' => 'Trang chủ - Thế Giới Đồ Uống (Demo SEO)',
            'meta_desc' => 'Danh sách các loại trà sữa, cà phê ngon nhất. Demo cấu trúc Internal Link cho SEO.',
        ]);
    }

    // Trang chi tiết sản phẩm
    public function detail(Product $product) {
        $relatedProducts = Product::where('id', '!=', $product->id)
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();
        // Schema.org: Giúp Google hiểu đây là sản phẩm có giá tiền
        $schema = [
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => $product->name,
            "image" => $product->image_url,
            "description" => $product->meta_description,
            "offers" => [
                "@type" => "Offer",
                "price" => $product->price,
                "priceCurrency" => "VND"
            ]
        ];

        return view('product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts, 
            // Nếu không có meta riêng, dùng tên sản phẩm làm title
            'meta_title' => $product->name . ' | Đồ Uống Ngon', 
            'meta_desc' => $product->meta_description,
            'schema_json' => json_encode($schema)
        ]);
    }
    public function search(Request $request) {
        $query = $request->input('q');
        
        // Tìm kiếm tương đối dùng LIKE
        $products = Product::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        return view('home', [
            'products' => $products,
            'meta_title' => "Kết quả tìm kiếm: $query",
            'meta_desc' => "Tìm thấy " . count($products) . " kết quả cho từ khóa $query"
        ]);
    }
}