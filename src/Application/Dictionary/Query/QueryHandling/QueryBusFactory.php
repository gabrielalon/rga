<?php

namespace RGA\Application\Dictionary\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Dictionary\Query;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\AbstractQueryBusFactory;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryBus;

class QueryBusFactory extends AbstractQueryBusFactory
{
    /**
     * @param QueryBus $queryBus
     * @param ContainerInterface $container
     */
    public function populate(QueryBus $queryBus, ContainerInterface $container): void
    {
        $dictionaryRepository = $container->get(Query\V1\DictionaryQueryInterface::class);
        
        $this->queryRouter
            ->route(Query\V1\FindAll::class)
            ->to(new Query\V1\FindAllHandler($dictionaryRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindAllByType::class)
            ->to(new Query\V1\FindAllByTypeHandler($dictionaryRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindAllByTypeAndBehaviourUuid::class)
            ->to(new Query\V1\FindAllByTypeAndBehaviourUuidHandler($dictionaryRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindOneByUuid::class)
            ->to(new Query\V1\FindOneByUuidHandler($dictionaryRepository))
        ;
        
        $this->attachRoutesToQueryBus($queryBus);
    }
}
