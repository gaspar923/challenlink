<?php

namespace App\Domain\ValueObjects;

class SellIn
{
    function __construct(
        private int $amount
    ) {
        // 
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }
}
