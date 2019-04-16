<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByActiveDomainFilter extends \FilterIterator
{
    /** @var string */
    private $domain;
    
    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }
    
    /**
     * @param array $domains
     * @return bool
     */
    private function isInDomains(array $domains): bool
    {
        return \in_array($this->domain, $domains);
    }
    
    /**
     * @return bool
     */
    public function accept(): bool
    {
        /** @var Viewable $view */
        $view = $this->getInnerIterator()->current();
        
        try {
            $reflection = new \ReflectionClass($view);
            $method = $reflection->getMethod('domains');
            
            return $this->isInDomains($method->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
