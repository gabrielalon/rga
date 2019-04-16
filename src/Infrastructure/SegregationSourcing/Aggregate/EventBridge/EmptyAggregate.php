<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class EmptyAggregate extends AggregateChanged
{
    /**
     * @param AggregateRoot $aggregateRoot
     */
    public function populate(AggregateRoot $aggregateRoot): void
    {
        $aggregateRoot->setAggregateId($this->aggregateId());
    }
}
