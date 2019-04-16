<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate\Persist;

use RGA\Infrastructure\SegregationSourcing\Aggregate;

class AggregateRepositoryDecorator extends AggregateRepository
{
    /**
     * @return AggregateRepositoryDecorator
     * @throws \ReflectionException
     */
    public static function newInstance()
    {
        $reflection = new \ReflectionClass(AggregateRepositoryDecorator::class);
        
        /** @var AggregateRepositoryDecorator $decorator */
        $decorator = $reflection->newInstanceWithoutConstructor();
        
        return $decorator;
    }
    
    /**
     * @return string
     */
    public function getAggregateRootClass(): string
    {
        throw new \BadMethodCallException('The AggregateRepositoryDecorator does not have an root');
    }
    
    /**
     * @param Aggregate\AggregateRoot $aggregateRoot
     * @param AggregateRepository $aggregateRepository
     */
    public function recordAggregateRootInRepository(Aggregate\AggregateRoot $aggregateRoot, AggregateRepository $aggregateRepository)
    {
        $aggregateRepository->saveAggregateRoot($aggregateRoot);
    }
}
