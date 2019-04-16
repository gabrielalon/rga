<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByRgaUuidFilter extends \FilterIterator
{
    /** @var string */
    private $uuid;
    
    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
    
    /**
     * @param string $uuid
     * @return bool
     */
    private function hasUuid(string $uuid): bool
    {
        return $this->uuid === $uuid;
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
            $method = $reflection->getMethod('rgaUuid');
            
            return $this->hasUuid($method->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
