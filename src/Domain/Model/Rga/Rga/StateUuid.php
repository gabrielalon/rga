<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class StateUuid
{
    /** @var string */
    private $uuid;
    
    /**
     * @param string $uuid
     * @return StateUuid
     */
    public static function fromString(string $uuid): StateUuid
    {
        return new StateUuid($uuid);
    }
    
    /**
     * @param string $uuid
     */
    private function __construct(string $uuid)
    {
        Assertion::uuid($uuid, 'Invalid StateUuid string: ' . $uuid);
        
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
     * @param StateUuid $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof StateUuid) {
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
