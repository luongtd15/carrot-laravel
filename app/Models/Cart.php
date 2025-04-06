<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',        // ID của người dùng
        'product_id',     // ID của sản phẩm
        'quantity',       // Số lượng sản phẩm
        'price',          // Giá sản phẩm
        'total_price',   // Tổng tiền sản phẩm
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->product->price;
    }
}
