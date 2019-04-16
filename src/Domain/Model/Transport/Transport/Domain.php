<?php

namespace RGA\Domain\Model\Transport\Transport;

use RGA\Application\Assert\Assertion;

final class Domain
{
    /** @var string */
    private $domain;
    
    /**
     * @param string $domain
     * @return Domain
     */
    public static function fromString(string $domain): Domain
    {
        return new Domain($domain);
    }
    
    /**
     * @param string $domain
     */
    private function __construct(string $domain)
    {
        Assertion::string($domain, 'Invalid domain string: ' . $domain);
        
        $this->domain = $domain;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @param Domain $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Domain) {
            return false;
        }
        
        return $this->domain === $other->domain;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->domain;
    }
}
