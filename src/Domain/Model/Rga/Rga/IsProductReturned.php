<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class IsProductReturned
{
    /** @var boolean */
    private $productReturned;
    
    /**
     * @param bool $activation
     * @return IsProductReturned
     */
    public static function fromBoolean(bool $activation): IsProductReturned
    {
        return new IsProductReturned($activation);
    }
    
    /**
     * @param boolean $activation
     */
    private function __construct(bool $activation)
    {
        Assertion::boolean($activation, 'Invalid IsProductReturned boolean: ' . $activation);
        
        $this->productReturned = $activation;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @return bool
     */
    public function raw(): bool
    {
        return $this->productReturned;
    }
    
    /**
     * @param IsProductReturned $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof IsProductReturned) {
            return false;
        }
        
        return $this->productReturned === $other->productReturned;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->productReturned ? '1' : '0';
    }
}
