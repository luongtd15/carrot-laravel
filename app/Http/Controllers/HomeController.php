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
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->paginate(12);

        $shirts = Product::with('category')
            ->where('quantity', '>', 0)
            ->where('category_id', 1)
            ->orderByDesc('id')
            ->get();

        $trousers = Product::with('category')
            ->where('category_id', 2)
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->paginate(4);

        $shoes = Product::with('category')
            ->where('category_id', 5)
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->paginate(8);
        // dd($shoes);
        $t_shirts = Product::with('category')
            ->where('quantity', '>', 0)
            ->where('category_id', 3)
            ->orderByDesc('id')
            ->paginate(8);
        $bestsellers = Product::with('category')
            ->where('quantity', '>', 0)
            ->orderByDesc('id')
            ->paginate(12);
        return view('home', [
            'products' => $products,
            'bestsellers' => $bestsellers,
            'shirts' => $shirts,
            'shoes' => $shoes,
            't_shirts' => $t_shirts,
            'trousers' => $trousers,
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
