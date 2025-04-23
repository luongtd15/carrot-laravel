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
        $comments = $product->comments()->paginate(4);
        $bestsellers = Product::with('category')
            ->where('category_id', $product->category_id)
            ->orderByDesc('sold_count')
            ->take(10)
            ->get();

        $validOrderId = null;
        $canReview = false;

        if (Auth::check()) {
            $userId = Auth::id();

            // Kiểm tra xem người dùng đã đánh giá chưa (check trong session)
            $reviewedOrder = session('reviewed_orders.' . $product->id);

            if (!$reviewedOrder) {
                // Lấy các đơn hàng hợp lệ chứa sản phẩm này
                $validOrders = OrderDetail::where('product_id', $product->id)
                    ->whereHas('order', function ($query) use ($userId) {
                        $query->where('user_id', $userId)
                            ->where('status', 'completed')
                            ->whereDate('updated_at', '>=', now()->subDays(7));
                    })
                    ->with('order')
                    ->get();

                foreach ($validOrders as $orderDetail) {
                    // Kiểm tra xem sản phẩm này trong đơn hàng đã được đánh giá chưa
                    $hasCommented = Comment::where('user_id', $userId)
                        ->where('product_id', $orderDetail->product_id)
                        ->where('order_id', $orderDetail->order_id)
                        ->exists();

                    if (!$hasCommented) {
                        $canReview = true;
                        $validOrderId = $orderDetail->order_id;
                        break;
                    }
                }
            } else {
                $canReview = false;
            }
        }

        return view('products.show', [
            'comments' => $comments,
            'product' => $product,
            'bestsellers' => $bestsellers,
            'canReview' => $canReview,
            'validOrderId' => $validOrderId ?? null, // Đảm bảo không có lỗi nếu không có order_id
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
