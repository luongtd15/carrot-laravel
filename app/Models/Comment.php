<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'user_id',
        'content',
        'rating',
        'order_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
