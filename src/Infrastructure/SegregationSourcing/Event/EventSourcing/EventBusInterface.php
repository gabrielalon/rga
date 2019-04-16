<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;

interface EventBusInterface extends MessageBusInterface
{
    /**
     * @param EventInterface $event
     */
    public function dispatch(EventInterface $event);
}
