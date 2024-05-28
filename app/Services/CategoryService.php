<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function listCategory():LengthAwarePaginator
    {
        return Category::paginate(20);
    }

    public function show(int $categoryId):?Model
    {
        return Category::query()->find($categoryId);
    }

    public function store(array $params): ?Model
    {
        /** @var Category $category */
        $category= Category::query()->create(array_merge($params,['profile_photo_path'=>'']));
        $category->updateProfilePhoto($params['photo'],'category-photos');
        return $category;
    }

    public function update(Category $category,array $params):bool
    {
        $result=$category->update($params);
        if(isset($params['photo'])){
            $category->updateProfilePhoto($params['photo'],'category-photos');
        }
        return $result;
    }

    public function delete(Category $category):bool
    {
        return $category->delete();
    }

}
