<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()) {
            return view('cart', ['carts' => collect(), 'totalPrice' => 0]); // Giỏ hàng trống nếu chưa đăng nhập
        }

        $userId = Auth::user()->id;
        $cartItems = Cart::whereHas('product') // Chỉ lấy cart có product còn tồn tại
            ->with('user', 'product')
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->paginate(12);

        // Tính tổng dựa trên tất cả items, không chỉ trang hiện tại
        $totalPrice = Cart::where('user_id', $userId)->sum('total_price');
        // dd($cartItems);

        $products = Product::with('category')
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->get();
        return view('cart', [
            'carts' => $cartItems,
            'totalPrice' => $totalPrice,
            'products' => $products,
        ]);
    }

    // CartController.php
    // Trong CartController.php
    public function update(Request $request)
    {
        $userId = Auth::user()->id;
        $cartItem = Cart::where('id', $request->id)
            ->where('user_id', $userId)
            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found or unauthorized'], 404);
        }

        // Lấy thông tin sản phẩm từ bảng products
        $product = Product::findOrFail($cartItem->product_id);

        // Kiểm tra số lượng tồn kho
        $requestedQuantity = $request->quantity;
        if ($requestedQuantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => "Số lượng yêu cầu ($requestedQuantity) vượt quá số lượng tồn kho ($product->quantity)!",
            ], 422);
        }

        // Cập nhật giỏ hàng nếu số lượng hợp lệ
        $cartItem->quantity = $requestedQuantity;
        $cartItem->total_price = $cartItem->price * $cartItem->quantity;
        $cartItem->save();

        $unitPrice = $cartItem->price;
        $totalPrice = $cartItem->total_price;
        $cartTotal = Cart::where('user_id', $userId)->sum('total_price');

        return response()->json([
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'cart_total' => $cartTotal
        ]);
    }

    public function addToCart(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'message' => 'You need to log in first.',
                'need_login' => true
            ]);
        }

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        // Kiểm tra số lượng tồn kho
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->first();

        $currentQuantityInCart = $cart ? $cart->quantity : 0;
        $totalRequestedQuantity = $currentQuantityInCart + $quantity;

        if ($totalRequestedQuantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => "Requested quantity ($totalRequestedQuantity) cannot be greater than available stock ($product->quantity).",
            ], 422);
        }

        // Nếu đủ hàng, thêm hoặc cập nhật giỏ
        if ($cart) {
            $cart->quantity += $quantity;
            $cart->total_price = $cart->price * $cart->quantity;
            $cart->save();
        } else {
            $cart = Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_price' => $product->price * $quantity,
            ]);
        }

        $cartTotal = Cart::where('user_id', Auth::user()->id)
            ->sum('total_price');

        return response()->json([
            'success' => true,
            'message' => 'Successfully!',
            'cart_total' => $cartTotal,
            'cart' => [
                'id' => $cart->id,
                'product_name' => $product->name,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
                'total_price' => $cart->total_price,
            ]
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
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::user()->id) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền xóa sản phẩm này!'], 403);
        }

        $cart->delete();

        $cartTotal = Cart::where('user_id', Auth::user()->id)
            ->sum('total_price');

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!',
            'cart_total' => $cartTotal // Tổng giá mới
        ]);
    }
}
