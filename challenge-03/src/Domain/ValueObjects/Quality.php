<?php

namespace App\Domain\ValueObjects;

class Quality
{
    function __construct(
        private int $amount
    ) {
        if ($amount < 0) throw new \InvalidArgumentException("Quality must not be negative");
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
