<?php

namespace RGA\Infrastructure\Persist\State;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class StateRepository extends AggregateRepository
{
    /**
     * @return string
     */
    public function getAggregateRootClass(): string
    {
        return State::class;
    }
    
    /**
     * @param State $dictionary
     */
    public function save(State $dictionary): void
    {
        $this->saveAggregateRoot($dictionary);
    }
    
    /**
     * @param string $uuid
     * @return State
     */
    public function find(string $uuid): State
    {
        /** @var State $state */
        $state = $this->findAggregateRoot($uuid);
        
        return $state;
    }
}
