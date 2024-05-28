<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function list():LengthAwarePaginator
    {
        $query=Product::query()->with('category');
        if (Auth::user()->role!='admin'){
            $query->where('created_by','=',Auth::user()->id);
        }
        return $query->paginate(20);
    }

    public function show(int $productId):?Model
    {
        return Product::query()->find($productId);
    }

    public function store(array $params): ?Model
    {
        return Product::query()->create($params);
    }

    public function update(Product $product,array $params):bool
    {
        return $product->update($params);
    }

    public function delete(Product $product):bool
    {
        return $product->delete();
    }

}
