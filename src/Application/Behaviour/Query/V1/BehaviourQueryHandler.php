<?php

namespace RGA\Application\Behaviour\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class BehaviourQueryHandler implements QueryHandlerInterface
{
    /** @var BehaviourQueryInterface */
    protected $repository;
    
    /**
     * @param BehaviourQueryInterface $repository
     */
    public function __construct(BehaviourQueryInterface $repository)
    {
        $this->repository = $repository;
    }
}
