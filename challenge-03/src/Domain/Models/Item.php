<?php

namespace App\Domain\Models;

use App\Domain\Contracts\ItemCategoryInterface;
use App\Domain\ValueObjects\Quality;
use App\Domain\ValueObjects\SellIn;

class Item
{
    public function __construct(
        private string  $name,
        private Quality $quality,
        private SellIn $sellIn,
        private ItemCategoryInterface $category
    ) {
        $this->category->validate($this);
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getQuality(): Quality
    {
        return $this->quality;
    }
    public function getSellIn(): SellIn
    {
        return $this->sellIn;
    }

    public function tick(): void
    {
        $this->category->validate($this);
        $this->category->tick($this);
    }
}
