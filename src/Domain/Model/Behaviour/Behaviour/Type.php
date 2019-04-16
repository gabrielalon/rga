<?php

namespace RGA\Domain\Model\Behaviour\Behaviour;

use RGA\Application\Assert\Assertion;
use RGA\Application\Behaviour\Enum;

final class Type
{
    /** @var string */
    private $type;
    
    /**
     * @param string $type
     * @return Type
     */
    public static function fromString(string $type): Type
    {
        return new Type($type);
    }
    
    /**
     * @param string $type
     */
    private function __construct(string $type)
    {
        Assertion::choice($type, (new Enum\Type())->getConstList(), 'Invalid Type string: ' . $type);
        
        $this->type = $type;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @param Type $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Type) {
            return false;
        }
        
        return $this->type === $other->type;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->type;
    }
}
