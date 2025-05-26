<?php

namespace App\Domain\Factories;

use App\Domain\Categories\BackstageCategory;
use App\Domain\Categories\BrieCategory;
use App\Domain\Categories\ConjuredCategory;
use App\Domain\Categories\NormalCategory;
use App\Domain\Categories\SulfurasCategory;
use App\Domain\Models\Item;
use App\Domain\ValueObjects\Quality;
use App\Domain\ValueObjects\SellIn;

class ItemFactory
{
    public static function create(string $name, int $quality, int $sellIn, string $category): Item
    {
        return new Item(
            $name,
            new Quality($quality),
            new SellIn($sellIn),
            match (strtolower($category)) {
                'normal'    => new NormalCategory(),
                'brie'    => new BrieCategory(),
                'sulfuras'    => new SulfurasCategory(),
                'backstage'    => new BackstageCategory(),
                'conjured'    => new ConjuredCategory(),
                default     => throw new \InvalidArgumentException("Invalid category")
            },
        );
    }
}
