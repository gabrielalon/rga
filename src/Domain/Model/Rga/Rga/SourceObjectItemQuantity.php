<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class SourceObjectItemQuantity
{
    /** @var float */
    private $quantity;

    public static function fromFloat(float $quantity): SourceObjectItemQuantity
    {
        return new SourceObjectItemQuantity($quantity);
    }

    private function __construct(float $quantity)
    {
        Assertion::float($quantity, 'Invalid SourceObjectItemQuantity float: ' . $quantity);
        
        $this->quantity = $quantity;
    }

    public function toString(): string
    {
        return $this->quantity;
    }

    public function equals(SourceObjectItemQuantity $other): bool
    {
        if (false === $other instanceof self) {
            return false;
        }
        
        return $this->quantity === $other->quantity;
    }

    public function __toString(): string
    {
        return (string)$this->quantity;
    }
}
