<?php

namespace RGA\Infrastructure\Projection\Dictionary;

use RGA\Application\Dictionary\Event;
use RGA\Application\Dictionary\Query\ReadModel;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;

class InMemoryDictionaryProjector implements DictionaryProjectorInterface
{
    /** @var ReadModel\Dictionary[] */
    private $entities = [];
    
    /**
     * @param Event\NewDictionaryCreated $event
     */
    public function onNewDictionaryCreated(Event\NewDictionaryCreated $event): void
    {
        $this->entities[$event->dictionaryUuid()->toString()] = ReadModel\Dictionary::fromUuid($event->dictionaryUuid())
            ->setType($event->dictionaryType())
            ->setEntries($event->dictionaryValues())
            ->setBehaviours($event->dictionaryBehaviours())
        ;
    }
    
    /**
     * @param Event\ExistingDictionaryChanged $event
     */
    public function onExistingDictionaryChanged(Event\ExistingDictionaryChanged $event): void
    {
        $entity = $this->get($event->aggregateId());
        $entity->setEntries($event->dictionaryValues());
        $entity->setBehaviours($event->dictionaryBehaviours());
        $this->entities[$event->aggregateId()] = $entity;
    }
    
    /**
     * @param Event\ExistingDictionaryRemoved $event
     */
    public function onExistingDictionaryRemoved(Event\ExistingDictionaryRemoved $event): void
    {
        unset($this->entities[$event->aggregateId()]);
    }
    
    /**
     * @param string $uuid
     * @return ReadModel\Dictionary
     */
    public function get(string $uuid): ReadModel\Dictionary
    {
        if (false === isset($this->entities[$uuid])) {
            throw new \RuntimeException('Dictionary entity not found for uuid: ' . $uuid);
        }
        
        return $this->entities[$uuid];
    }
}
