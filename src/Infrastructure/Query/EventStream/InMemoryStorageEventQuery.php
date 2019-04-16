<?php

namespace RGA\Infrastructure\Query\EventStream;

use RGA\Application\SegregationSourcing\Query\ReadModel\StorageEventCollection;
use RGA\Application\SegregationSourcing\Query\V1\FindAllByEventId;
use RGA\Application\SegregationSourcing\Query\V1\StorageEventQueryInterface;

class InMemoryStorageEventQuery implements StorageEventQueryInterface
{
    /**
     * @param FindAllByEventId $query
     */
    public function findAllByEventId(FindAllByEventId $query): void
    {
        $query->setViewCollection(new StorageEventCollection([]));
    }
}
