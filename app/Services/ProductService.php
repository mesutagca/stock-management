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
        return Product::query()->with('category')->find($productId);
    }

    public function store(array $params): ?Model
    {
        /** @var Product $product */
        $product=Product::query()->create(array_merge($params,['profile_photo_path'=>'']));
        $product->updateProfilePhoto($params['photo'],'product-photos');
        return $product;
    }

    public function update(Product $product,array $params):bool
    {
       $result= $product->update($params);
        if(isset($params['photo'])){
            $product->updateProfilePhoto($params['photo'],'product-photos');
        }
        return $result;
    }

    public function delete(Product $product):bool
    {
        return $product->delete();
    }

}
