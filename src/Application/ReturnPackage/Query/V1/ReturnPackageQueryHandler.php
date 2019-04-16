<?php

namespace RGA\Application\ReturnPackage\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class ReturnPackageQueryHandler implements QueryHandlerInterface
{
    /** @var ReturnPackageQueryInterface */
    protected $repository;
    
    /**
     * @param ReturnPackageQueryInterface $repository
     */
    public function __construct(ReturnPackageQueryInterface $repository)
    {
        $this->repository = $repository;
    }
}
