<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class IsFinishable
{
    /** @var boolean */
    private $finishable;
    
    /**
     * @param bool $finishable
     * @return IsFinishable
     */
    public static function fromBoolean(bool $finishable): IsFinishable
    {
        return new IsFinishable($finishable);
    }
    
    /**
     * @param boolean $finishable
     */
    private function __construct(bool $finishable)
    {
        Assertion::boolean($finishable, 'Invalid IsFinishable boolean: ' . $finishable);
        
        $this->finishable = $finishable;
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
        return $this->finishable;
    }
    
    /**
     * @param IsFinishable $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof IsFinishable) {
            return false;
        }
        
        return $this->finishable === $other->finishable;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->finishable ? '1' : '0';
    }
}
