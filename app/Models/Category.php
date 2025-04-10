<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    protected $dates = ['deleted_at']; // Đảm bảo cột deleted_at được xử lý như ngày giờ
}
