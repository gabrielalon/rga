<?php

namespace RGA\Infrastructure\Model\Translate\Translate;

use RGA\Application\Assert\Assertion;

final class Value
{
    /** @var string */
    private $value;
    
    /**
     * @param string $value
     * @return Value
     */
    public static function fromString(string $value): Value
    {
        return new Value($value);
    }
    
    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        Assertion::string($value, 'Invalid Value string: ' . $value);
        $this->value = $value;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @param Value $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Value) {
            return false;
        }
        
        return $this->value === $other->value;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
