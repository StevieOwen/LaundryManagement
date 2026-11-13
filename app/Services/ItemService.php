<?php

namespace App\Services;
use App\Models\Category;
use App\Models\Item;


class ItemService{
    public function storeItem(array $data){
        $item=Item::make($data);
        return $item;
    }

    public function updateItem(Item $item, array $data){
        // Define the fields you want to allow for modification
        $allowedFields = ['designation','category_id'];

        // Filter the incoming array to only include allowed keys, then update & save
        $user->update(array_intersect_key($data, array_flip($allowedFields)));

        return $item;
    }

    public function deleteItem(Item $item){
        $item->delete();
    }
}