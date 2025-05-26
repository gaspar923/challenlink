<?php

namespace App\Domain\Services;

use App\Domain\Factories\ItemFactory;
use App\Domain\Models\Item;

class ItemService
{
    function createItem(array $data): Item
    {
        $item = ItemFactory::create(
            $data['name'],
            $data['quality'],
            $data['sell_in'],
            $data['category'],
        );

        return $item;
    }
}
