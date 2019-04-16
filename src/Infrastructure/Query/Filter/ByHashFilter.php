<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByHashFilter extends \FilterIterator
{
    /** @var string */
    private $hash;
    
    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }
    
    /**
     * @param string $hash
     * @return bool
     */
    private function hasHash(string $hash): bool
    {
        return $this->hash === $hash;
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
            $method = $reflection->getMethod('hash');
            
            return $this->hasHash($method->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
