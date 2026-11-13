<?php

namespace App\Services;
use App\Models\Category;

class CategoryService{

    public function storeCategory(array $data){
        $category=Category::make($data);
        return $category;
    }   

    public function updateCategory(Category $category, array $data){

        // Define the fields you want to allow for modification
        $allowedFields = ['name','description'];

        // Filter the incoming array to only include allowed keys, then update & save
        $user->update(array_intersect_key($data, array_flip($allowedFields)));

        return $category;
    }

    public function deleteCategory(Category $category){
        $category->delete();
    }
}