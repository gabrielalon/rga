<?php

namespace RGA\Application\Transport\Event;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingTransportRemoved extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @param Aggregate\AggregateRoot|Transport $state
     */
    public function populate(Aggregate\AggregateRoot $state): void
    {
        // no need to do anything
    }
}
