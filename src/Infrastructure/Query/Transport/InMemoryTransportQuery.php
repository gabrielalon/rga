<?php

namespace RGA\Infrastructure\Query\Transport;

use RGA\Application\Transport\Query;
use RGA\Application\Transport\Query\V1\FindAllActive;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryTransportQuery implements Query\V1\TransportQueryInterface
{
    /** @var Query\ReadModel\TransportCollection*/
    private $entities;
    
    /**
     * @param Query\ReadModel\Transport $view
     */
    public function store(Query\ReadModel\Transport $view): void
    {
        if (null === $this->entities) {
            $this->entities = new Query\ReadModel\TransportCollection();
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
        
        /** @var Query\ReadModel\Transport $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'Transport not found by uuid: ' . $query->getUuid(),
            404
        );
    }
    
    /**
     * @param Query\V1\FindAllActiveForDomain $query
     */
    public function findAllActiveForDomain(Query\V1\FindAllActiveForDomain $query): void
    {
        $collection = new Query\ReadModel\TransportCollection();
        
        $filter = new Filter\ByActiveDomainFilter($this->entities);
        $filter->setDomain($query->getDomain());
        $filter->rewind();
        
        while ($filter->valid()) {
            /** @var Query\ReadModel\Transport $view */
            $view = $filter->current();
            
            $collection->add($view);
            $filter->next();
        }
        
        $query->setViewCollection($collection);
    }
    
    /**
     * @param FindAllActive $query
     */
    public function findAllActive(FindAllActive $query): void
    {
        $collection = new Query\ReadModel\TransportCollection();
        
        $filter = new Filter\ByActiveFilter($this->entities);
        $filter->setActive(true);
        $filter->rewind();
        
        while ($filter->valid()) {
            /** @var Query\ReadModel\Transport $view */
            $view = $filter->current();
            
            $collection->add($view);
            $filter->next();
        }
        
        $query->setViewCollection($collection);
    }
    
    /**
     * @param Query\V1\FindAll $query
     */
    public function findAll(Query\V1\FindAll $query): void
    {
        $query->setViewCollection(new Query\ReadModel\TransportCollection($this->entities->all()));
    }
}
