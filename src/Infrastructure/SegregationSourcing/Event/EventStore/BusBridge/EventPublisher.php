<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventStore\BusBridge;

use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventSourcing\EventBusInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\EventStorage;

class EventPublisher
{
    /** @var EventBusInterface */
    private $eventBus;
    
    /**
     * @param EventBusInterface $eventBus
     */
    public function __construct(EventBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }
    
    /**
     * @param EventStorage $eventStorage
     */
    public function attachToEventStorage(EventStorage $eventStorage)
    {
        $eventStorage->setEventPublisher($this);
    }
    
    /**
     * @param EventInterface $event
     */
    public function release(EventInterface $event)
    {
        $this->eventBus->dispatch($event);
    }
}
