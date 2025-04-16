<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $url = route('product.show', ['id' => $productId]) . '#review-tab';

        if ($validator->fails()) {
            return redirect()->to($url)
                ->withErrors($validator)
                ->withInput()
                ->with('error_message', 'Comment submission failed!');
        }

        $validated = $validator->validated();

        // Kiểm tra đơn hàng đã mua, trạng thái completed và trong vòng 7 ngày
        $hasValidCompletedOrder = OrderDetail::where('product_id', $validated['product_id'])
            ->whereHas('order', function ($query) use ($validated) {
                $query->where('user_id', $validated['user_id'])
                    ->where('status', 'completed')
                    ->whereDate('updated_at', '>=', now()->subDays(7));
            })
            ->exists();

        if (!$hasValidCompletedOrder) {
            return redirect()->to($url)
                ->withInput()
                ->with('error_message', 'You can only comment on products you have purchased!');
        }

        Comment::create($validated);

        return redirect()->to($url)->with('success', 'Comment submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
