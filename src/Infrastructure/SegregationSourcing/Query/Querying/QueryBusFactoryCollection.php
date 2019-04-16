<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Querying;

use Psr\Container\ContainerInterface;

class QueryBusFactoryCollection
{
    /** @var AbstractQueryBusFactory[] */
    private $factories = [];
    
    /**
     * @param AbstractQueryBusFactory $queryBusFactory
     */
    public function register(AbstractQueryBusFactory $queryBusFactory): void
    {
        $this->factories[] = $queryBusFactory;
    }
    
    /**
     * @param QueryBus $queryBus
     * @param ContainerInterface $container
     */
    public function populate(QueryBus $queryBus, ContainerInterface $container): void
    {
        foreach ($this->factories as $factory) {
            $factory->populate($queryBus, $container);
        }
    }
}
