<?php

namespace RGA\Domain\Model\Behaviour\Projection;

use RGA\Application\Behaviour\Event;

interface BehaviourProjectorInterface
{
    /**
     * @param Event\NewBehaviourCreated $event
     */
    public function onNewBehaviourCreated(Event\NewBehaviourCreated $event): void;
    
    /**
     * @param Event\ExistingBehaviourChanged $event
     */
    public function onExistingBehaviourChanged(Event\ExistingBehaviourChanged $event): void;
}
