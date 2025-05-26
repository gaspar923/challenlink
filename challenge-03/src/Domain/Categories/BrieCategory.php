<?php

namespace App\Domain\Categories;

use App\Domain\Contracts\ItemCategoryInterface;
use App\Domain\Models\Item;

class BrieCategory implements ItemCategoryInterface
{
    public function tick(Item $item): void
    {
        if ($item->getQuality()->getAmount() < 50) {
            $item->getQuality()->setAmount($item->getQuality()->getAmount() + 1);
        }

        $item->getSellIn()->setAmount($item->getSellIn()->getAmount() - 1);

        if (
            $item->getSellIn()->getAmount() < 0 &&
            $item->getQuality()->getAmount() < 50
        ) {
            $item->getQuality()->setAmount($item->getQuality()->getAmount() + 1);
        }
    }

    public function validate(Item $item): void
    {
        if ($item->getQuality()->getAmount() > 50) {
            throw new \InvalidArgumentException("Quality must not be more than 50.");
        }
    }
}
