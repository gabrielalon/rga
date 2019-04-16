<?php

namespace RGA\Application\SegregationSourcing\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class StorageEventQueryHandler implements QueryHandlerInterface
{
    /** @var StorageEventQueryInterface */
    protected $repository;
    
    /**
     * @param StorageEventQueryInterface $repository
     */
    public function __construct(StorageEventQueryInterface $repository)
    {
        $this->repository = $repository;
    }
}
