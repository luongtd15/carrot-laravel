<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID của người dùng
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // ID của sản phẩm
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->decimal('total_price', 10, 2); // Tổng tiền sản phẩm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
