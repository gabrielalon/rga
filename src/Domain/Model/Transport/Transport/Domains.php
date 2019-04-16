<?php

namespace RGA\Domain\Model\Transport\Transport;

use RGA\Application\Assert\Assertion;
use RGA\Application\Transport\Utils;

final class Domains
{
    /** @var array */
    private $domains;
    
    /**
     * @param array $domains
     * @return Domains
     */
    public static function fromArray(array $domains): Domains
    {
        return new Domains($domains);
    }
    
    /**
     * @param array $domains
     */
    protected function __construct(array $domains)
    {
        Assertion::isArray($domains, 'Invalid Domains array');
        
        $collection = new Utils\Collection();
        
        foreach ($domains as $domain) {
            $collection->add(Domain::fromString($domain));
        }
        
        $this->domains = $collection;
    }
    
    /**
     * @param string $domain
     */
    public function addDomain(string $domain): void
    {
        $this->domains->add(Domain::fromString($domain));
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @param Domains $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Domains) {
            return false;
        }
        
        return $this->domains->equals($other->domains);
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return \serialize($this->raw());
    }
    
    /**
     * @return array
     */
    public function raw(): array
    {
        $domains = [];
        
        /** @var Domain $domain */
        foreach ($this->all() as $domain) {
            $domains[] = $domain->toString();
        }
        
        return $domains;
    }
    
    /**
     * @return Domain[]
     */
    public function all(): array
    {
        return $this->domains->getArrayCopy();
    }
}
