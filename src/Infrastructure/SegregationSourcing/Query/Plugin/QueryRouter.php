<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Plugin;

use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\QueryRouterInterface;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryBusInterface;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

class QueryRouter implements QueryRouterInterface
{
    /** @var string */
    private $tmpQueryName;
    
    /** @var QueryHandlerInterface[][] */
    private $handlerMap = [];
    
    /**
     * @param string $queryName
     * @return QueryRouterInterface
     */
    public function route(string $queryName): QueryRouterInterface
    {
        if (true === empty($queryName)) {
            throw new \InvalidArgumentException('Query name cannot be empty');
        }
        
        $this->tmpQueryName = $queryName;
        
        return $this;
    }
    
    /**
     * @param QueryHandlerInterface $handler
     */
    public function to(QueryHandlerInterface $handler): void
    {
        if (true === empty($this->tmpQueryName)) {
            throw new \RuntimeException('Please provide query name first with route method');
        }
        
        $this->handlerMap[$this->tmpQueryName][] = $handler;
    }
    
    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->handlerMap;
    }
    
    /**
     * @param QueryRouterInterface $router
     */
    public function merge(QueryRouterInterface $router): void
    {
        $this->handlerMap = \array_merge($this->handlerMap, $router->getMap());
    }
    
    /**
     * @param string $queryName
     * @return QueryHandlerInterface[]
     */
    public function map(string $queryName): array
    {
        return $this->handlerMap[$queryName];
    }
    
    /**
     * @param QueryBusInterface $bus
     */
    public function attachToQueryBus(QueryBusInterface $bus): void
    {
        $bus->setRouter($this);
    }
}
