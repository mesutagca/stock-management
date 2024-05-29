<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->list();

        return view('product/product', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryService $categoryService)
    {
        $categories=$categoryService->getAll();
        return view('product/product-ekle',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'=>'required|numeric',
            'name' => 'required|string|unique:products|max:50',
            'amount'=>'required|numeric',
            'photo' => [
                'required',
                File::image()
            ]
        ]);
        $this->productService->store(array_merge($validated,['user_id'=>Auth::user()->id]));
        return redirect()->route('products.index');
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
    public function edit(string $id,CategoryService $categoryService)
    {
        $product=$this->productService->show($id);
        $categories=$categoryService->getAll();
        return view('product/product-ekle',['product'=>$product, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $productId,Request $request)
    {
        /** @var Product $product */
        $product=$this->productService->show($productId);

        $validated = $request->validate([
            'category_id'=>'required|numeric',
            'name' => 'required|string|max:50',
            'amount'=>'required|numeric',
            'photo' => [
                File::image()
            ]
        ]);

        $this->productService->update($product,$validated);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /** @var Product $product */
        $product=$this->productService->show($id);
        $this->productService->delete($product);
        return redirect()->route('products.index');
    }
}
