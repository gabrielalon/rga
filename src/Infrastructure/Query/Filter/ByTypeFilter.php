<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByTypeFilter extends \FilterIterator
{
    /** @var string */
    protected $type;
    
    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    
    /**
     * @param string $type
     * @return bool
     */
    protected function hasType(string $type): bool
    {
        return $type === $this->type;
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
            $method = $reflection->getMethod('type');
            
            return $this->hasType($method->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
