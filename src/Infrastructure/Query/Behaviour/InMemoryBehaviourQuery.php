<?php

namespace RGA\Infrastructure\Query\Behaviour;

use RGA\Application\Behaviour\Query;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryBehaviourQuery implements Query\V1\BehaviourQueryInterface
{
    /** @var Query\ReadModel\BehaviourCollection*/
    private $entities;
    
    /**
     * @param Query\ReadModel\Behaviour $view
     */
    public function store(Query\ReadModel\Behaviour $view): void
    {
        if (null === $this->entities) {
            $this->entities = new Query\ReadModel\BehaviourCollection();
        }
        
        $this->entities->add($view);
    }
    
    /**
     * @param Query\V1\FindOneByUuid $query
     */
    public function findOneByUuid(Query\V1\FindOneByUuid $query): void
    {
        $filter = new Filter\ByUuidFilter($this->entities);
        $filter->setUuid($query->getUuid());
        $filter->rewind();
        
        /** @var Query\ReadModel\Behaviour $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'Behaviour not found by uuid: ' . $query->getUuid(),
            404
        );
    }
    
    /**
     * @param Query\V1\FindOneByType $query
     */
    public function findOneByType(Query\V1\FindOneByType $query): void
    {
        $filter = new Filter\ByTypeFilter($this->entities);
        $filter->setType($query->getType());
        $filter->rewind();
        
        /** @var Query\ReadModel\Behaviour $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'Behaviour not found by type: ' . $query->getType(),
            404
        );
    }
    
    /**
     * @param Query\V1\FindAll $query
     */
    public function findAll(Query\V1\FindAll $query): void
    {
        $query->setViewCollection(new Query\ReadModel\BehaviourCollection($this->entities->all()));
    }
    
    /**
     * @param Query\V1\FindAllActive $query
     */
    public function findAllActive(Query\V1\FindAllActive $query): void
    {
        $collection = new Query\ReadModel\BehaviourCollection();
        
        $filter = new Filter\ByActiveFilter($this->entities);
        $filter->setActive(true);
        $filter->rewind();
        
        while ($filter->valid()) {
            /** @var Query\ReadModel\Behaviour $view */
            $view = $filter->current();
            
            $collection->add($view);
            $filter->next();
        }
        
        $query->setViewCollection($collection);
    }
}
