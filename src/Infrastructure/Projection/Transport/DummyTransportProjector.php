<?php

namespace RGA\Infrastructure\Projection\Transport;

use RGA\Application\Transport\Event;
use RGA\Domain\Model\Transport\Projection;

class DummyTransportProjector implements Projection\TransportProjectorInterface
{
    /**
     * @param Event\NewTransportCreated $event
     */
    public function onNewTransportCreated(Event\NewTransportCreated $event): void
    {
        // TODO: Implement onNewTransportCreated() method.
    }
    
    /**
     * @param Event\ExistingTransportChanged $event
     */
    public function onExistingTransportChanged(Event\ExistingTransportChanged $event): void
    {
        // TODO: Implement onExistingTransportChanged() method.
    }
    
    /**
     * @param Event\ExistingTransportRemoved $event
     */
    public function onExistingTransportRemoved(Event\ExistingTransportRemoved $event): void
    {
        // TODO: Implement onExistingTransportRemoved() method.
    }
}
