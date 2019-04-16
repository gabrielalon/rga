<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByNameFilter extends \FilterIterator
{
    /** @var array */
    private $name;
    
    /**
     * @param array $name
     */
    public function setName(array $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @param array $names
     * @return bool
     */
    public function hasAnyName(array $names): bool
    {
        foreach ($this->name as $name) {
            if (\in_array($name, $names)) {
                return true;
            }
        }
        
        return false;
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
            $method = $reflection->getMethod('names');
            
            return $this->hasAnyName($method->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
