<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $byDescCategories = Category::orderByDesc('id')->withTrashed()->get();
        return view('admin.categories.index', ['byDescCategories' => $byDescCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = $imagePath;
        }

        // Mặc định nếu is_active không được gửi
        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        // Lưu vào DB
        $category = Category::create($validated);

        // Kiểm tra nếu đây là yêu cầu AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => 'Category created successfully!',
                'category' => $category
            ]);
        }

        // Nếu không phải yêu cầu Ajax thì redirect
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::find($id);
        // Kiểm tra nếu category không tồn tại
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found!');
        }
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::find($id);
        // dd($category->image);
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        // Nếu category không tồn tại, trả về lỗi
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found!');
        }

        // Validate dữ liệu, bỏ qua unique nếu tên không thay đổi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id, // Chỉ kiểm tra uniqueness khi tên thay đổi
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // Kiểm tra nếu có ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($category->image) {
                $oldImagePath = storage_path('app/public/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Xóa ảnh cũ
                }
            }

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $validated['image'] = $category->image;
        }

        // Cập nhật thông tin category
        $category->update($validated);

        return redirect()->route('admin.categories.edit', ['category' => $category->id])
            ->with('success', 'Category updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found!');
        }

        // Xóa file ảnh nếu tồn tại
        if ($category->image) {
            $imagePath = storage_path('app/public/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file ảnh
            }
        }

        $category->delete(); // Soft delete nếu dùng SoftDeletes, hard delete nếu không
        $category->update(['is_active' => 0]);

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
