<?php

namespace RGA\Domain\Model\Behaviour\Behaviour;

use RGA\Application\Assert\Assertion;

final class Uuid
{
    /** @var string */
    private $uuid;
    
    /**
     * @param string $uuid
     * @return Uuid
     */
    public static function fromString(string $uuid): Uuid
    {
        return new Uuid($uuid);
    }
    
    /**
     * @param string $uuid
     */
    private function __construct(string $uuid)
    {
        Assertion::uuid($uuid, 'Invalid Uuid string: ' . $uuid);
        
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
     * @param Uuid $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Uuid) {
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
