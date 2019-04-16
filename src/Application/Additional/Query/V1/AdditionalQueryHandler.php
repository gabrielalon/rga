<?php

namespace RGA\Application\Additional\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class AdditionalQueryHandler implements QueryHandlerInterface
{
    /** @var AdditionalQueryInterface */
    protected $repository;
    
    /**
     * @param AdditionalQueryInterface $repository
     */
    public function __construct(AdditionalQueryInterface $repository)
    {
        $this->repository = $repository;
    }
}
