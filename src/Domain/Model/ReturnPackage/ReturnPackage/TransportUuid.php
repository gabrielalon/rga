<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class TransportUuid
{
    /** @var string */
    private $uuid;
    
    /**
     * @param string $uuid
     * @return TransportUuid
     */
    public static function fromString(string $uuid): TransportUuid
    {
        return new TransportUuid($uuid);
    }
    
    /**
     * @param string $uuid
     */
    private function __construct(string $uuid)
    {
        Assertion::uuid($uuid, 'Invalid TransportUuid string: ' . $uuid);
        
        $this->uuid = $uuid;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->uuid;
    }
    
    /**
     * @param TransportUuid $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof TransportUuid) {
            return false;
        }
        
        return $this->uuid === $other->uuid;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->uuid;
    }
}
