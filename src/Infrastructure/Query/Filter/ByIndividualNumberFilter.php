<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByIndividualNumberFilter extends \FilterIterator
{
    /** @var string */
    private $individualNumber;
    
    /**
     * @param string $individualNumber
     */
    public function setIndividualNumber(string $individualNumber): void
    {
        $this->individualNumber = $individualNumber;
    }
    
    /**
     * @param string $individualNumber
     * @return bool
     */
    public function hasIndividualNumber(string $individualNumber): bool
    {
        return $this->individualNumber === $individualNumber;
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
            $method = $reflection->getMethod('individualNumber');
            
            return $this->hasIndividualNumber($method->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
