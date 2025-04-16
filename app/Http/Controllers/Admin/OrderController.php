<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::with('user', 'orderDetails.product', 'address')->orderByDesc('id')->get();
        return view('admin.orders.index', compact('orders'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $order = Order::with('user', 'orderDetails.product', 'address')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,delivering,completed,canceled',
        ]);

        $allowedTransitions = [
            'pending' => ['confirmed', 'canceled'],
            'confirmed' => ['delivering', 'canceled'],
            'delivering' => ['completed', 'canceled'],
            'completed' => [],
            'canceled' => [],
        ];

        $order = Order::findOrFail($id);
        if (!in_array($request->status, $allowedTransitions[$order->status])) {
            return redirect()->back()->with('error', "Cannot change status from '{$order->status}' to '{$request->status}'.");
        }
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.edit', $order->id)->with('success', 'Order status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
