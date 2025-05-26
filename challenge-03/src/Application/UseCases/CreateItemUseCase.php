<?php

namespace App\Application\UseCases;

use App\Domain\Services\ItemService;

class CreateItemUseCase
{
    public function __construct(private ItemService $itemService) {}

    function execute(array $data)
    {
        return $this->itemService->createItem($data);
    }
}
