<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->paginate(12);
        // dd($products);
        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $product = Product::with(['category', 'comments', 'images'])
            ->where('quantity', '>', 0)->findOrFail($id);
        $bestsellers = Product::with('category')
            ->where('category_id', $product->category_id)
            ->orderByDesc('sold_count')
            ->take(10)
            ->get();

        $canReview = false;

        if (Auth::check()) {
            $userId = Auth::user()->id;

            // Tìm đơn hàng hợp lệ
            $validOrder = OrderDetail::where('product_id', $product->id)
                ->whereHas('order', function ($query) use ($userId) {
                    $query->where('user_id', $userId)
                        ->where('status', 'completed')
                        ->whereDate('updated_at', '>=', now()->subDays(7)); // hoặc 'completed_at' nếu có
                })
                ->first();

            if ($validOrder) {
                // Kiểm tra chưa có comment nào của user cho sản phẩm này
                $hasCommented = Comment::where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->exists();

                $canReview = !$hasCommented;
            }
        }
        return view('products.show', [
            'product' => $product,
            'bestsellers' => $bestsellers,
            'canReview' => $canReview,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
