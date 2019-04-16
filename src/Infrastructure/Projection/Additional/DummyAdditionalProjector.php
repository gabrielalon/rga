<?php

namespace RGA\Infrastructure\Projection\Additional;

use RGA\Application\Additional\Event;
use RGA\Domain\Model\Additional\Projection;

class DummyAdditionalProjector implements Projection\AdditionalProjectorInterface
{
    /**
     * @param Event\NewAdditionalCreated $event
     */
    public function onNewAdditionalCreated(Event\NewAdditionalCreated $event): void
    {
        // TODO: Implement onNewAdditionalCreated() method.
    }
}
