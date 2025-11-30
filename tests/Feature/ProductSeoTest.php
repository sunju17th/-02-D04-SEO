<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Product;

class ProductSeoTest extends TestCase
{
    // Trait này giúp reset database sau mỗi lần test (để dữ liệu luôn sạch)
    use RefreshDatabase; 

    /** @test */
    public function it_can_create_product_and_auto_generate_slug()
    {
        // 1. Giả lập dữ liệu gửi lên (KHÔNG gửi slug)
        $data = [
            'name' => 'Trà Sữa Trân Châu',
            'price' => 35000,
            'description' => 'Mô tả ngắn gọn về trà sữa.',
            'meta_description' => 'Meta custom',
        ];

        // 2. Gửi request POST đến route lưu
        $response = $this->post(route('admin.store'), $data);

        // 3. Kiểm tra:
        // - Redirect về trang index
        $response->assertRedirect(route('admin.index'));
        
        // - Database phải có dòng dữ liệu với slug đã được tạo
        $this->assertDatabaseHas('products', [
            'name' => 'Trà Sữa Trân Châu',
            'slug' => 'tra-sua-tran-chau' // <--- Logic SEO quan trọng nhất
        ]);
    }

    /** @test */
    public function it_auto_generates_meta_description_if_left_empty()
    {
        // Tạo một mô tả rất dài
        $longDescription = str_repeat("Đây là mô tả rất dài. ", 20); 

        $data = [
            'name' => 'Cà Phê Muối',
            'price' => 25000,
            'description' => $longDescription,
            'meta_description' => null, // Cố tình bỏ trống
        ];

        $this->post(route('admin.store'), $data);

        // Lấy sản phẩm vừa tạo ra kiểm tra
        $product = Product::where('name', 'Cà Phê Muối')->first();

        // Kiểm tra xem meta_description có được tự động điền không
        $this->assertNotNull($product->meta_description);
        
        // Kiểm tra độ dài có bị cắt xuống <= 150 ký tự không (theo logic Controller)
        $this->assertTrue(mb_strlen($product->meta_description) <= 153);
    }

    /** @test */
    public function it_uploads_and_renames_image_for_seo()
    {
        // 1. Giả lập ổ đĩa 'public'
        Storage::fake('public');

        // 2. Tạo một file ảnh giả
        $file = UploadedFile::fake()->image('anh-lung-tung.jpg');

        $data = [
            'name' => 'Hồng Trà Tắc',
            'price' => 20000,
            'description' => 'Mô tả...',
            'image' => $file
        ];

        $this->post(route('admin.store'), $data);

        // 3. Kiểm tra Database lưu đúng đường dẫn
        // Tên file mong muốn: hong-tra-tac.jpg (slug + đuôi file)
        // Lưu ý: Do code controller có thể thêm time() hoặc hash, ta kiểm tra xem path có chứa folder products không
        $product = Product::where('name', 'Hồng Trà Tắc')->first();
        
        $this->assertStringContainsString('/storage/products/', $product->image_url);
        $this->assertStringContainsString('hong-tra-tac', $product->image_url); // Tên file phải chứa slug
    }

    /** @test */
    public function it_requires_name_and_price()
    {
        // Gửi dữ liệu rỗng
        $response = $this->post(route('admin.store'), []);

        // Mong đợi lỗi validation ở trường 'name' và 'price'
        $response->assertSessionHasErrors(['name', 'price']);
    }
    
    /** @test */
    public function guest_can_view_product_detail_page()
    {
        // Tạo sẵn 1 sản phẩm
        $product = Product::create([
            'name' => 'Trà Đào',
            'slug' => 'tra-dao',
            'price' => 30000,
            'description' => 'Ngon tuyệt',
            'meta_description' => 'Meta trà đào',
            'image_url' => '/test.jpg'
        ]);

        // Truy cập vào URL chi tiết
        $response = $this->get(route('product.detail', $product->slug));

        // Kiểm tra Status 200 (OK)
        $response->assertStatus(200);
        
        // Kiểm tra xem trong HTML trả về có chứa Title chuẩn SEO không
        $response->assertSee('Trà Đào');
        $response->assertSee('Meta trà đào'); // Kiểm tra meta description có xuất hiện
    }
}