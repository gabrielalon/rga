<?php

namespace RGA\Infrastructure\Query\Attachment;

use RGA\Application\Attachment\Query;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryAttachmentQuery implements Query\V1\AttachmentQueryInterface
{
    /** @var Query\ReadModel\AttachmentCollection*/
    private $entities;
    
    /**
     * @param Query\ReadModel\Attachment $view
     */
    public function store(Query\ReadModel\Attachment $view): void
    {
        if (null === $this->entities) {
            $this->entities = new Query\ReadModel\AttachmentCollection();
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
        
        /** @var Query\ReadModel\Attachment $view */
        if ($view = $filter->current()) {
            $query->setView($view);
            return;
        }
        
        throw new Exception\ResourceNotFoundException(
            'Attachment not found by uuid: ' . $query->getUuid(),
            404
        );
    }
    
    /**
     * @param Query\V1\FindAllByRgaUuid $query
     */
    public function findAllByRgaUuid(Query\V1\FindAllByRgaUuid $query): void
    {
        $collection = new Query\ReadModel\AttachmentCollection();
        
        $filter = new Filter\ByRgaUuidFilter($this->entities);
        $filter->setUuid($query->getUuid());
        $filter->rewind();
        
        while ($filter->valid()) {
            /** @var Query\ReadModel\Attachment $view */
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
        $offset = max($query->getPage() - 1, 0) * $query->getLimit();
        
        $query->setViewCollection(new Query\ReadModel\AttachmentCollection(
            \array_slice($this->entities->all(), $offset, $query->getLimit())
        ));
    }
}
