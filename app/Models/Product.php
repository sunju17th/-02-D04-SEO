<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = []; // Cho phép điền dữ liệu nhanh

    // Bảo Laravel: "Khi tìm trên URL, hãy dùng cột slug"
    public function getRouteKeyName()
    {
        return 'slug';
    }
}