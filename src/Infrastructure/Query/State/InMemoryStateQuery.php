<?php

namespace RGA\Infrastructure\Query\State;

use RGA\Application\State\Query;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryStateQuery implements Query\V1\StateQueryInterface
{
    /** @var Query\ReadModel\StateCollection*/
    private $entities;
    
    /**
     * @param Query\ReadModel\State $view
     */
    public function store(Query\ReadModel\State $view): void
    {
        if (null === $this->entities) {
            $this->entities = new Query\ReadModel\StateCollection();
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
        
        /** @var Query\ReadModel\State $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'State not found by uuid: ' . $query->getUuid(),
            404
        );
    }
    
    /**
     * @param Query\V1\FindOneByRgaUuid $query
     */
    public function findOneByRgaUuid(Query\V1\FindOneByRgaUuid $query): void
    {
        $filter = new Filter\ByRgaUuidFilter($this->entities);
        $filter->setUuid($query->getUuid());
        $filter->rewind();
        
        /** @var Query\ReadModel\State $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'State not found by rga uuid: ' . $query->getUuid(),
            404
        );
    }
    
    /**
     * @param Query\V1\FindOneByName $query
     */
    public function findOneByName(Query\V1\FindOneByName $query): void
    {
        $filter = new Filter\ByNameFilter($this->entities);
        $filter->setName($query->getName());
        $filter->rewind();
        
        /** @var Query\ReadModel\State $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'State not found by names: ' . \json_encode($query->getName()),
            404
        );
    }
    
    /**
     * @param Query\V1\FindAll $query
     */
    public function findAll(Query\V1\FindAll $query): void
    {
        $query->setViewCollection(new Query\ReadModel\StateCollection($this->entities->all()));
    }
}
