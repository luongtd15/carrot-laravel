<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
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
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $dates = ['deleted_at']; // Đảm bảo cột deleted_at được xử lý như ngày giờ
}
