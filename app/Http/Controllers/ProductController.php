<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
    public function create()
    {
        return view('product/product-ekle');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'=>'required|numeric|max:5',
            'name' => 'required|string|unique:categories|max:50'
        ]);
        $this->productService->store($validated);
        return $this->index();
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
        $product=$this->productService->show($id);
        return view('product/product-guncelle',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /** @var Product $product */
        $product=$this->productService->show($id);

        $validated = $request->validate([
            'name' => 'string|unique:categories|max:50',
            'amount'=>'numeric'
        ]);

        $this->productService->update($product,$validated);
        return $this->index();
    }

    public function changeAmount(string $id, string $type='decrease')
    {
        /** @var Product $product */
        $product=$this->productService->show($id);
        $amount=$type=='decrease' ? $product->amount-1 : $product->amount+1;
dd($amount);
            $this->productService->update($product,['amount'=>$amount]);
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /** @var Product $product */
        $product=$this->productService->show($id);
        $this->productService->delete($product);
        return $this->index();
    }
}
