<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Querying;

use Psr\Container\ContainerInterface;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\QueryRouterInterface;
use RGA\Infrastructure\SegregationSourcing\Query\Plugin\QueryRouter;

abstract class AbstractQueryBusFactory
{
    /** @var QueryRouter|QueryRouterInterface */
    protected $queryRouter;
    
    /**
     * @param QueryRouter|QueryRouterInterface $commandRouter
     */
    public function __construct(QueryRouterInterface $commandRouter)
    {
        $this->queryRouter = $commandRouter;
    }
    
    /**
     * @param QueryBus $queryBus
     */
    protected function attachRoutesToQueryBus(QueryBus $queryBus)
    {
        $queryBus->injectRoutes($this->queryRouter);
    }
    
    /**
     * @param QueryBus $queryBus
     * @param ContainerInterface $container
     */
    abstract public function populate(QueryBus $queryBus, ContainerInterface $container): void;
}
