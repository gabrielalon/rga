<?php

namespace RGA\Infrastructure\Projection\State;

use RGA\Application\State\Event;
use RGA\Domain\Model\State\Projection;

class DummyStateProjector implements Projection\StateProjectorInterface
{
    /**
     * @param Event\NewStateCreated $event
     */
    public function onNewStateCreated(Event\NewStateCreated $event): void
    {
        // TODO: Implement onNewStateCreated() method.
    }
    
    /**
     * @param Event\ExistingStateChanged $event
     */
    public function onExistingStateChanged(Event\ExistingStateChanged $event): void
    {
        // TODO: Implement onExistingStateChanged() method.
    }
    
    /**
     * @param Event\ExistingStateRemoved $event
     */
    public function onExistingStateRemoved(Event\ExistingStateRemoved $event): void
    {
        // TODO: Implement onExistingStateRemoved() method.
    }
}
