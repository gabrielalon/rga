<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class SourceObjectType
{
    /** @var string */
    private $type;
    
    /**
     * @param string $type
     * @return SourceObjectType
     */
    public static function fromString(string $type): SourceObjectType
    {
        return new SourceObjectType($type);
    }
    
    /**
     * @param string $type
     */
    private function __construct(string $type)
    {
        Assertion::string($type, 'Invalid SourceObjectType string: ' . $type);
        
        $this->type = $type;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->type;
    }
    
    /**
     * @param SourceObjectType $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof SourceObjectType) {
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
