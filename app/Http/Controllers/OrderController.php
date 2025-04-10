<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart; // Thêm import cho model Cart
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $userID = Auth::user()->id;
        $orders = Order::with('orderDetails.product')
            ->where('user_id', '=', $userID)
            ->orderByDesc('id')
            ->get();
        // dd($order);
        return view(
            'orders.index',
            [
                'user' => $userID,
                'orders' => $orders
            ]
        );
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'new_address.address' => 'required_if:address_id,null',
            'new_address.commune' => 'required_if:address_id,null',
            'new_address.district' => 'required_if:address_id,null',
            'new_address.city' => 'required_if:address_id,null',
        ], [
            'new_address.address.required_if' => 'Vui lòng nhập địa chỉ nếu không chọn địa chỉ có sẵn!',
            // Thêm thông báo lỗi khác nếu cần
        ]);

        $carts = Cart::with('user', 'product')
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        foreach ($carts as $item) {
            if ($item->quantity > $item->product->quantity) {
                return redirect()->back()->with('error', "Sản phẩm {$item->product->name} không đủ số lượng trong kho!");
            }
        }

        $totalAmount = $carts->sum('total_price');

        // Xử lý địa chỉ
        $addressId = null;
        if ($request->filled('address_id')) {
            // Người dùng chọn địa chỉ có sẵn
            $addressId = $request->input('address_id');
            $address = Address::where('id', $addressId)->where('user_id', $userId)->first();
            if (!$address) {
                return redirect()->back()->with('error', 'Địa chỉ không hợp lệ!');
            }
        } elseif ($request->filled('new_address.address', 'new_address.commune', 'new_address.district', 'new_address.city')) {
            // Người dùng nhập địa chỉ mới
            $newAddressData = $request->input('new_address');
            $address = Address::create([
                'user_id' => $userId,
                'address' => $newAddressData['address'],
                'commune' => $newAddressData['commune'],
                'district' => $newAddressData['district'],
                'city' => $newAddressData['city'],
                'is_default' => false, // Có thể thêm logic để set mặc định nếu cần
            ]);
            $addressId = $address->id;
        } else {
            return redirect()->back()->with('error', 'Choose or input a new address pls!');
        }

        // Bắt đầu transaction
        DB::beginTransaction();
        try {
            // Tạo đơn hàng với address_id
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'total_amount' => $totalAmount,
                'address_id' => $addressId, // Thêm address_id vào đơn hàng
            ]);

            // Thêm chi tiết đơn hàng
            foreach ($carts as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->total_price,
                ]);

                $product = $item->product;
                $newQuantity = $product->quantity - $item->quantity;
                $newSold = $product->sold_count + $item->quantity;
                if ($newQuantity < 0) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ hàng trong kho!");
                }
                $product->update(['quantity' => $newQuantity, 'sold_count' => $newSold]);
            }

            // Xóa giỏ hàng
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('order.show', ['user' => $userId, 'order' => $order->id])
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Place order: ' . $e->getMessage());
        }
    }

    public function checkout()
    {
        $userId = Auth::user()->id;
        // $address = Address::with('user')->find($userId)->first();
        // dd($address);
        $carts = Cart::with('user', 'product')
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->get();

        if ($carts->isEmpty()) { // Sử dụng isEmpty() để kiểm tra collection
            return redirect()->back()->with('error', 'No products in your cart. Add at least one to proceed to checkout.');
        }

        $totalPrice = Cart::where('user_id', $userId)->sum('total_price');

        return view('checkout', compact('carts', 'totalPrice'));
    }

    public function show($userId, $orderId)
    {
        $userIdAuth = Auth::user()->id;
        // $user = User::with('addresses')->find($userId);
        // $address = Address::with('user')->find($userId)->first();
        $totalPrice = Cart::where('user_id', $userId)->sum('total_price');

        $order = Order::with('orderDetails.product', 'address')
            ->where('user_id', $userId)
            ->where('id', $orderId)
            ->first();

        if (!$order || $userId != $userIdAuth) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại hoặc bạn không có quyền xem!');
        }

        return view('orders.show', compact('order', 'totalPrice'));
    }


    public function cancel($userId, $orderId)
    {
        // Kiểm tra quyền: đảm bảo user đang đăng nhập khớp với userId từ tham số
        if (Auth::user()->id != $userId) {
            return redirect()->back()->with('error', 'Bạn không có quyền hủy đơn hàng này!');
        }

        try {
            // Tìm đơn hàng
            $order = Order::where('user_id', $userId)
                ->where('id', $orderId)
                ->with('orderDetails.product') // Eager load để tối ưu
                ->firstOrFail();

            // Kiểm tra trạng thái đơn hàng - mở rộng danh sách không thể hủy
            $cannotCancelStatuses = ['canceled', 'delivering', 'delivered', 'completed'];
            if (in_array($order->status, $cannotCancelStatuses)) {
                return redirect()->back()->with('error', 'You cannot cancel this order now!');
            }

            // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
            DB::beginTransaction();
            try {
                // Cập nhật trạng thái đơn hàng thành 'canceled'
                $order->status = 'canceled';
                $order->save();

                // Hoàn trả số lượng sản phẩm
                foreach ($order->orderDetails as $orderDetail) {
                    $product = $orderDetail->product;
                    if ($product) { // Kiểm tra sản phẩm tồn tại
                        $product->quantity += $orderDetail->quantity;
                        $product->sold_count -= $orderDetail->quantity;
                        if ($product->sold_count < 0) {
                            $product->sold_count = 0; // Đảm bảo sold_count không âm
                        }
                        // Cập nhật lại số lượng sản phẩm
                        $product->save();
                    } else {
                        throw new \Exception("This product is not exist in #{$orderDetail->id}!");
                    }
                }

                // Commit transaction
                DB::commit();

                return redirect()->back()->with('success', 'The order has been successfully canceled, and the product quantities have been returned.');
            } catch (\Exception $e) {
                // Rollback nếu có lỗi
                DB::rollBack();
                return redirect()->back()->with('error', 'Order cancel error: ' . $e->getMessage());
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Order is not exist!');
        }
    }
}
