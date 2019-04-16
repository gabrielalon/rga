<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class VatRate
{
    /** @var int */
    private $rate;
    
    /**
     * @param int $rate
     * @return VatRate
     */
    public static function fromInteger(int $rate): VatRate
    {
        return new VatRate($rate);
    }
    
    /**
     * @param int $rate
     */
    private function __construct(int $rate)
    {
        Assertion::integer($rate, 'Invalid VatRate int: ' . $rate);
        
        $this->rate = $rate;
    }
    
    /**
     * @return int
     */
    public function toString(): int
    {
        return $this->rate;
    }
    
    /**
     * @param VatRate $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof VatRate) {
            return false;
        }
        
        return $this->rate === $other->rate;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->rate;
    }
}
