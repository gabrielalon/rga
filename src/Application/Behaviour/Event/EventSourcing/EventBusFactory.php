<?php

namespace RGA\Application\Behaviour\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\Behaviour\Event;
use RGA\Domain\Model\Behaviour\Projection;
use RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

class EventBusFactory extends EventSourcing\AbstractEventBusFactory
{
    /**
     * @param EventSourcing\EventBus $eventBus
     * @param ContainerInterface $container
     */
    public function populate(EventSourcing\EventBus $eventBus, ContainerInterface $container): void
    {
        /** @var Projection\BehaviourProjectorInterface $behaviourProjector */
        $behaviourProjector = $container->get(Projection\BehaviourProjectorInterface::class);
        
        $this->eventRouter
            ->route(Event\NewBehaviourCreated::class)
            ->to([$behaviourProjector, 'onNewBehaviourCreated']);
        
        $this->eventRouter
            ->route(Event\ExistingBehaviourChanged::class)
            ->to([$behaviourProjector, 'onExistingBehaviourChanged']);
        
        
        $this->attachRoutesToEventBus($eventBus);
    }
}
