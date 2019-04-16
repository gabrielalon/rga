<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class Metadata
{
    /** @var array */
    private $metadata;
    
    /**
     * @param string $metadata
     * @return Metadata
     */
    public static function fromString(string $metadata): Metadata
    {
        return new Metadata($metadata);
    }
    
    /**
     * @param string $metadata
     */
    private function __construct(string $metadata)
    {
        Assertion::string($metadata, 'Invalid Metadata string: ' . $metadata);
        
        $this->metadata = (array)@\json_decode($metadata, true);
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @return array
     */
    public function raw(): array
    {
        return $this->metadata;
    }
    
    /**
     * @param Metadata $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Metadata) {
            return false;
        }
        
        return $this->metadata === $other->metadata;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return \json_encode($this->metadata);
    }
}
