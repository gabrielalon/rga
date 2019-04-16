<?php

namespace RGA\Domain\Model\Behaviour\Behaviour;

use RGA\Application\Assert\Assertion;

final class Active
{
    /** @var boolean */
    private $active;
    
    /**
     * @param bool $active
     * @return Active
     */
    public static function fromBoolean(bool $active): Active
    {
        return new Active($active);
    }
    
    /**
     * @param boolean $active
     */
    private function __construct(bool $active)
    {
        Assertion::boolean($active, 'Invalid Active boolean: ' . $active);
        
        $this->active = $active;
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
        return $this->active;
    }
    
    /**
     * @param Active $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Active) {
            return false;
        }
        
        return $this->active === $other->active;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->active ? '1' : '0';
    }
}
