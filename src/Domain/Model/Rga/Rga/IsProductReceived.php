<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class IsProductReceived
{
    /** @var boolean */
    private $productReceived;
    
    /**
     * @param bool $activation
     * @return IsProductReceived
     */
    public static function fromBoolean(bool $activation): IsProductReceived
    {
        return new IsProductReceived($activation);
    }
    
    /**
     * @param boolean $activation
     */
    private function __construct(bool $activation)
    {
        Assertion::boolean($activation, 'Invalid IsProductReceived boolean: ' . $activation);
        
        $this->productReceived = $activation;
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
        return $this->productReceived;
    }
    
    /**
     * @param IsProductReceived $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof IsProductReceived) {
            return false;
        }
        
        return $this->productReceived === $other->productReceived;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->productReceived ? '1' : '0';
    }
}
