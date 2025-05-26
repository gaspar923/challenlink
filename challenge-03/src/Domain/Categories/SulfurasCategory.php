<?php

namespace App\Domain\Categories;

use App\Domain\Contracts\ItemCategoryInterface;
use App\Domain\Models\Item;

class SulfurasCategory implements ItemCategoryInterface
{
    public function tick(Item $item): void
    {
        $item->getSellIn()->setAmount($item->getSellIn()->getAmount() - 1);
    }

    public function validate(Item $item): void
    {
        if ($item->getQuality()->getAmount() != 80) {
            throw new \InvalidArgumentException("Quality must be equal to 80.");
        }
    }
}
