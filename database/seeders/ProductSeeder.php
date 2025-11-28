<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        Product::create([
            'name' => 'Trà Sữa Trân Châu Đường Đen',
            'slug' => 'tra-sua-tran-chau-duong-den', // URL sẽ là /menu/tra-sua-tran-chau-duong-den
            'description' => 'Sự kết hợp hoàn hảo giữa trà sữa thơm béo và trân châu đường đen nấu chậm.',
            'meta_description' => 'Mua trà sữa trân châu đường đen ngon nhất Đà Nẵng. Hương vị đậm đà, trân châu dai giòn.',
            'price' => 35000,
            'image_url' => 'https://via.placeholder.com/600x400?text=Tra+Sua'
        ]);

        Product::create([
            'name' => 'Cà Phê Muối Huế',
            'slug' => 'ca-phe-muoi-hue',
            'description' => 'Vị đắng của cà phê hòa quyện với lớp kem muối mặn ngọt béo ngậy.',
            'meta_description' => 'Cà phê muối chuẩn vị Huế. Giao hàng tận nơi, đảm bảo hương vị độc đáo.',
            'price' => 29000,
            'image_url' => 'https://via.placeholder.com/600x400?text=Ca+Phe+Muoi'
        ]);
    }
}
