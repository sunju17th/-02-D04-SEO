<?php
namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    // Trang chủ
    public function index() {
        return view('home', [
            'meta_title' => 'Trang chủ - Thế Giới Đồ Uống',
            'meta_desc' => 'Website bán đồ uống demo tính năng SEO với Laravel.',
        ]);
    }

    // Trang chi tiết sản phẩm
    public function detail(Product $product) {
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
            // Nếu không có meta riêng, dùng tên sản phẩm làm title
            'meta_title' => $product->name . ' | Đồ Uống Ngon', 
            'meta_desc' => $product->meta_description,
            'schema_json' => json_encode($schema)
        ]);
    }
}