<?php

namespace App;

use App\Application\UseCases\CreateItemUseCase;

class GildedRose
{
    function __construct(
        private CreateItemUseCase $createItemUseCase,
    ) {}

    public function of($name, $quality, $sellIn, $category)
    {
        $data = [
            'name' => $name,
            'quality' => $quality,
            'sell_in' => $sellIn,
            'category' => $category,
        ];

        $item = $this->createItemUseCase->execute($data);
        return $item;
    }
}
