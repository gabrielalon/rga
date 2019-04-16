<?php

namespace RGA\Infrastructure\SegregationSourcing\Plugin\Routing;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryBusInterface;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

interface QueryRouterInterface extends RouterInterface
{
    /**
     * @param string $queryName
     * @return QueryRouterInterface
     */
    public function route(string $queryName): QueryRouterInterface;
    
    /**
     * @param QueryHandlerInterface $handler
     */
    public function to(QueryHandlerInterface $handler): void;
    
    /**
     * @return array
     */
    public function getMap(): array;
    
    /**
     * @param QueryRouterInterface $router
     */
    public function merge(QueryRouterInterface $router): void;
    
    /**
     * @param string $queryName
     * @return QueryHandlerInterface[]
     */
    public function map(string $queryName): array;
    
    /**
     * @param QueryBusInterface $bus
     */
    public function attachToQueryBus(QueryBusInterface $bus): void;
}
