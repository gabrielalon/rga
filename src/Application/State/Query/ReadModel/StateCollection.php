<?php

namespace RGA\Application\State\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class StateCollection extends \ArrayIterator implements ViewableCollection
{
    /**
     * @param State $stateView
     */
    public function add(State $stateView): void
    {
        $this->offsetSet($stateView->identifier(), $stateView);
    }
    
    /**
     * @param string $uuid
     * @return State
     */
    public function get(string $uuid): State
    {
        return $this->offsetGet($uuid);
    }
    
    /**
     * @param string $uuid
     * @return bool
     */
    public function has(string $uuid): bool
    {
        return $this->offsetExists($uuid);
    }
    
    /**
     * @return State[]
     */
    public function all(): array
    {
        return $this->getArrayCopy();
    }
}
