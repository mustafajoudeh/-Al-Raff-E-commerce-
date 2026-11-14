<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->when(request('q'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('CategoryName', 'like', "%{$search}%")
                        ->orWhere('Description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('category.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تمت إضافة التصنيف بنجاح.');
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم حذف التصنيف بنجاح.');
    }
}