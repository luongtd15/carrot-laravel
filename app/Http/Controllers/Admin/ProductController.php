<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->orderByDesc('id')->withTrashed()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $addProductCategories = Category::all();
        return view('admin.products.create', compact('addProductCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $price = $request->input('price');
                    if (!is_null($value) && $value >= $price) {
                        $fail('The sale price must be less than the regular price.');
                    }
                },
            ],
            'quantity' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Ảnh chính
            'additional_images.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Ảnh phụ
        ]);

        $slug = $validated['slug'] ?? \Illuminate\Support\Str::slug($validated['name']) . '-' . rand(1, 1000);

        // Xử lý ảnh chính
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Tạo sản phẩm mới
        $product = Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'image' => $imagePath,
            'description' => $validated['description'],
            'short_description' => $validated['short_description'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'quantity' => $validated['quantity'],
            'sold_count' => 0, // Giá trị mặc định
            'is_active' => $validated['is_active'],
            'is_featured' => $validated['is_featured'],
        ]);

        // Xử lý ảnh phụ
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $additionalImage) {
                $additionalImagePath = $additionalImage->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $additionalImagePath,
                ]);
            }
        }

        // Trả về phản hồi
        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::with('category', 'images')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::with('category', 'images')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Debug dữ liệu gửi từ form
        if ($request->has('delete_images')) {
            Log::info('delete_images received:', $request->input('delete_images'));
        } else {
            Log::info('No delete_images in request');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $price = $request->input('price');
                    if (!is_null($value) && $value >= $price) {
                        $fail('The sale price must be less than the regular price.');
                    }
                },
            ],
            'quantity' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'additional_images.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Xử lý ảnh chính
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
                Log::info('Deleted main image: ' . $product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            $validated['image'] = $product->image;
        }

        // Tạo slug nếu không có
        $validated['slug'] = $validated['slug'] ?? \Illuminate\Support\Str::slug($validated['name']) . '-' . rand(1, 1000);

        // Cập nhật sản phẩm
        $product->update($validated);

        // Xử lý xóa ảnh phụ
        if ($request->has('delete_images')) {
            $deleteImages = $request->input('delete_images');
            foreach ($deleteImages as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image) {
                    $path = $image->image_path;
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                        Log::info("Deleted additional image: $path");
                    } else {
                        Log::warning("Image not found in storage: $path");
                    }
                    $image->delete();
                    Log::info("Deleted ProductImage ID: $imageId");
                } else {
                    Log::warning("ProductImage not found: $imageId");
                }
            }
        }

        // Thêm ảnh phụ mới
        if ($request->hasFile('additional_images')) {
            $currentImageCount = $product->images->count();
            $newImageCount = count($request->file('additional_images'));
            if ($currentImageCount + $newImageCount > 5) {
                return back()->withErrors(['additional_images' => 'Maximum 5 additional images allowed'])->withInput();
            }

            foreach ($request->file('additional_images') as $additionalImage) {
                $path = $additionalImage->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
                Log::info("Added new additional image: $path");
            }
        }

        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->update(['is_active' => 0]);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function restore(string $id)
    {
        //
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        $product->update(['is_active' => 1]);
        return redirect()->route('admin.products.index')->with('success', 'Product restored successfully.');
    }
}
