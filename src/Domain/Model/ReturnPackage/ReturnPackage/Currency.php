<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class Currency
{
    /** @var string */
    private $currency;
    
    /**
     * @param string $currency
     * @return Currency
     */
    public static function fromString(string $currency): Currency
    {
        return new Currency($currency);
    }
    
    /**
     * @param string $currency
     */
    private function __construct(string $currency)
    {
        Assertion::string($currency, 'Invalid Currency string: ' . $currency);
        
        $this->currency = $currency;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->currency;
    }
    
    /**
     * @param Currency $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Currency) {
            return false;
        }
        
        return $this->currency === $other->currency;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->currency;
    }
}
