<?php

namespace RGA\Infrastructure\Persist\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class BehaviourRepository extends AggregateRepository
{
    /**
     * @return string
     */
    public function getAggregateRootClass(): string
    {
        return Behaviour::class;
    }
    
    /**
     * @param Behaviour $behaviour
     */
    public function save(Behaviour $behaviour): void
    {
        $this->saveAggregateRoot($behaviour);
    }
    
    /**
     * @param string $uuid
     * @return Behaviour
     */
    public function find(string $uuid): Behaviour
    {
        /** @var Behaviour $behaviour */
        $behaviour = $this->findAggregateRoot($uuid);
        
        return $behaviour;
    }
}
