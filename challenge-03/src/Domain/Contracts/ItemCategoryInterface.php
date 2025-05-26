<?php

namespace App\Domain\Contracts;

use App\Domain\Models\Item;

interface ItemCategoryInterface
{
    public function tick(Item $item): void;
    public function validate(Item $item): void;
}
