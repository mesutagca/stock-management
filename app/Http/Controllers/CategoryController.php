<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }
    }

    public function index(): View
    {
        $categories = $this->categoryService->listCategory();

        return view('category/category', ['categories' => $categories]);
    }

    public function create(): View
    {
        return view('category/category-ekle');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:50',
            'photo' => [
                'required',
                File::image()
            ]
        ]);

        $this->categoryService->store($validated);
        return redirect()->route('categories.index');
    }

    public function edit(int $categoryId): View
    {
        $category = $this->categoryService->show($categoryId);
        return view('category/category-ekle', ['category' => $category]);
    }

    public function update(int $categoryId, Request $request): RedirectResponse
    {
        /** @var Category $category */
        $category = $this->categoryService->show($categoryId);

        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,'.$category->id.'|max:50',
            'photo' => [
                File::image()
            ]
        ]);

        $this->categoryService->update($category, $validated);
        return redirect()->route('categories.index');
    }

    public function destroy(int $categoryId): RedirectResponse
    {
        /** @var Category $category */
        $category = $this->categoryService->show($categoryId);
        $this->categoryService->delete($category);
        return redirect()->route('categories.index');
    }
}
