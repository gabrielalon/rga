<?php

namespace RGA\Infrastructure\Query\Additional;

use RGA\Application\Additional\Query;
use RGA\Infrastructure\Query\Filter;

class InMemoryAdditionalQuery implements Query\V1\AdditionalQueryInterface
{
    /** @var Query\ReadModel\AdditionalCollection */
    private $entities;
    
    /**
     * @param Query\ReadModel\Additional $view
     */
    public function store(Query\ReadModel\Additional $view): void
    {
        if (null === $this->entities) {
            $this->entities = new Query\ReadModel\AdditionalCollection();
        }
        
        $this->entities->add($view);
    }
    
    /**
     * @param Query\V1\FindAllByRgaUuid $query
     */
    public function findAllByRgaUuid(Query\V1\FindAllByRgaUuid $query): void
    {
        $collection = new Query\ReadModel\AdditionalCollection();
        
        $filter = new Filter\ByRgaUuidFilter($this->entities);
        $filter->setUuid($query->getUuid());
        $filter->rewind();
        
        while ($filter->valid()) {
            /** @var Query\ReadModel\Additional $view */
            $view = $filter->current();
            
            $collection->add($view);
            $filter->next();
        }
        
        $query->setViewCollection($collection);
    }
}
