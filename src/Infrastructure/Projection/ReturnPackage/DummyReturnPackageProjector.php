<?php

namespace RGA\Infrastructure\Projection\ReturnPackage;

use RGA\Application\ReturnPackage\Event;
use RGA\Domain\Model\ReturnPackage\Projection;

class DummyReturnPackageProjector implements Projection\ReturnPackageProjectorInterface
{
    
    /**
     * @param Event\NewReturnPackageCreated $event
     */
    public function onNewReturnPackageCreated(Event\NewReturnPackageCreated $event): void
    {
        // TODO: Implement onNewReturnPackageCreated() method.
    }
    
    /**
     * @param Event\ReturnPackageSet $event
     */
    public function onReturnPackageSet(Event\ReturnPackageSet $event): void
    {
        // TODO: Implement onReturnPackageSet() method.
    }
}
