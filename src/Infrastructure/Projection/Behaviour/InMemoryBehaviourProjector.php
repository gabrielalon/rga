<?php

namespace RGA\Infrastructure\Projection\Behaviour;

use RGA\Application\Behaviour\Event;
use RGA\Application\Behaviour\Query\ReadModel;
use RGA\Domain\Model\Behaviour\Projection\BehaviourProjectorInterface;

class InMemoryBehaviourProjector implements BehaviourProjectorInterface
{
    /** @var ReadModel\Behaviour[] */
    private $entities = [];
    
    /**
     * @param Event\NewBehaviourCreated $event
     */
    public function onNewBehaviourCreated(Event\NewBehaviourCreated $event): void
    {
        $this->entities[$event->behaviourUuid()->toString()] = ReadModel\Behaviour::fromUuid($event->behaviourUuid())
            ->setType($event->behaviourType())
            ->setNames($event->behaviourNames())
            ->setActivation($event->behaviourActivation());
    }
    
    /**
     * @param Event\ExistingBehaviourChanged $event
     */
    public function onExistingBehaviourChanged(Event\ExistingBehaviourChanged $event): void
    {
        $entity = $this->get($event->aggregateId());
        $entity->setActivation($event->behaviourActivation());
        $entity->setNames($event->behaviourNames());
        $this->entities[$event->aggregateId()] = $entity;
    }
    
    /**
     * @param string $uuid
     * @return ReadModel\Behaviour
     */
    public function get(string $uuid): ReadModel\Behaviour
    {
        if (false === isset($this->entities[$uuid])) {
            throw new \RuntimeException('Behaviour entity not found for uuid: ' . $uuid);
        }
        
        return $this->entities[$uuid];
    }
}
