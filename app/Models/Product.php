<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'category_id',
        'price',
        'sale_price',
        'quantity',
        'sold_count', // Có thể bỏ nếu không muốn gán trực tiếp
        'is_active',
        'is_featured',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    protected $dates = ['deleted_at']; // Đảm bảo cột deleted_at được xử lý như ngày giờ
}
