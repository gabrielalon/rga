<?php

namespace RGA\Application\Rga\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Rga\Query;
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
        $rgaRepository = $container->get(Query\V1\RgaQueryInterface::class);
        
        $this->queryRouter
            ->route(Query\V1\FindAll::class)
            ->to(new Query\V1\FindAllHandler($rgaRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindOneByCode::class)
            ->to(new Query\V1\FindOneByCodeHandler($rgaRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindOneByHash::class)
            ->to(new Query\V1\FindOneByHashHandler($rgaRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindOneByIndividualNumber::class)
            ->to(new Query\V1\FindOneByIndividualNumberHandler($rgaRepository))
        ;
        
        $this->queryRouter
            ->route(Query\V1\FindOneByUuid::class)
            ->to(new Query\V1\FindOneByUuidHandler($rgaRepository))
        ;

		$this->queryRouter
			->route(Query\V1\FindOneByApplicantObjectId::class)
			->to(new Query\V1\FindOneByApplicantObjectIdHandler($rgaRepository))
		;
        
        $this->attachRoutesToQueryBus($queryBus);
    }
}
