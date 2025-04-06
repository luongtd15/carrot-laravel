<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('category')
            ->where('is_featured', '=', true)
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->paginate(12);
        $bestsellers = Product::with('category')
            ->where('quantity', '>', 0)
            ->orderByDesc('sold_count')
            ->take(6)
            ->get();
        return view('home', [
            'products' => $products,
            'bestsellers' => $bestsellers
        ]);
    }

    public function search(Request $request)
    {
        $q = strtolower(trim($request->input('q')));
        if (empty($q)) {
            return view('result', [
                'products' => [],
                'q' => $q
            ]);
        }
        // Validate the search query
        $products = Product::with('category')
            ->where('name', 'like', '%' . $q . '%')
            ->orderByDesc('id')
            ->paginate(12);
        // dd($products);

        if ($products->isEmpty()) {
            return view('result', [
                'products' => [],
                'q' => $q
            ]);
        }

        return view('result', [
            'products' => $products,
            'q' => $q
        ]);
    }
}
