<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class IsCashReturned
{
    /** @var boolean */
    private $cashReturned;
    
    /**
     * @param bool $activation
     * @return IsCashReturned
     */
    public static function fromBoolean(bool $activation): IsCashReturned
    {
        return new IsCashReturned($activation);
    }
    
    /**
     * @param boolean $activation
     */
    private function __construct(bool $activation)
    {
        Assertion::boolean($activation, 'Invalid IsCashReturned boolean: ' . $activation);
        
        $this->cashReturned = $activation;
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
        return $this->cashReturned;
    }
    
    /**
     * @param IsCashReturned $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof IsCashReturned) {
            return false;
        }
        
        return $this->cashReturned === $other->cashReturned;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->cashReturned ? '1' : '0';
    }
}
