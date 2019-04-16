<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByTypeAndBehaviourUuidFilter extends ByTypeFilter
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
     * @param array $identifiers
     * @return bool
     */
    private function hasUuid(array $identifiers = []): bool
    {
        return \in_array($this->uuid, $identifiers);
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
            $type = $reflection->getMethod('type');
            $behaviours = $reflection->getMethod('behaviours');
            
            return $this->hasType($type->invoke($view))
                && $this->hasUuid($behaviours->invoke($view));
        } catch (\Exception $e) {
            return false;
        }
    }
}
