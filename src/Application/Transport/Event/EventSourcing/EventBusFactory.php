<?php

namespace RGA\Application\Transport\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\Transport\Event;
use RGA\Domain\Model\Transport\Projection;
use RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

class EventBusFactory extends EventSourcing\AbstractEventBusFactory
{
    /**
     * @param EventSourcing\EventBus $eventBus
     * @param ContainerInterface $container
     */
    public function populate(EventSourcing\EventBus $eventBus, ContainerInterface $container): void
    {
        /** @var Projection\TransportProjectorInterface $transportProjector */
        $transportProjector = $container->get(Projection\TransportProjectorInterface::class);
        
        $this->eventRouter
            ->route(Event\NewTransportCreated::class)
            ->to([$transportProjector, 'onNewTransportCreated']);
        
        $this->eventRouter
            ->route(Event\ExistingTransportChanged::class)
            ->to([$transportProjector, 'onExistingTransportChanged']);
        
        $this->eventRouter
            ->route(Event\ExistingTransportRemoved::class)
            ->to([$transportProjector, 'onExistingTransportRemoved']);
        
        $this->attachRoutesToEventBus($eventBus);
    }
}
