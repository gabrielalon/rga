<?php

namespace RGA\Application\Dictionary\Event;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingDictionaryRemoved extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @param Aggregate\AggregateRoot|Dictionary $dictionary
     */
    public function populate(Aggregate\AggregateRoot $dictionary): void
    {
        // no need to do anything
    }
}
