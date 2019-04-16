<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class Hash
{
    /** @var string */
    private $hash;
    
    /**
     * @param string $hash
     * @return Hash
     */
    public static function fromString(string $hash): Hash
    {
        return new Hash($hash);
    }
    
    /**
     * @param string $hash
     */
    private function __construct(string $hash)
    {
        Assertion::string($hash, 'Invalid Hash string: ' . $hash);
        
        $this->hash = $hash;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->hash;
    }
    
    /**
     * @param Hash $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Hash) {
            return false;
        }
        
        return $this->hash === $other->hash;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->hash;
    }
}
