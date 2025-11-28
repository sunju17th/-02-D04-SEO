<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên sản phẩm (H1)
            $table->string('slug')->unique(); // URL thân thiện (quan trọng nhất cho SEO)
            $table->text('description'); // Nội dung chi tiết
            $table->string('meta_description')->nullable(); // Thẻ meta description cho Google
            $table->decimal('price', 10, 2);
            $table->string('image_url')->nullable(); // Link ảnh để làm SEO hình ảnh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
