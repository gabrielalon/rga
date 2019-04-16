<?php

namespace RGA\Application\Dictionary\Event;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Application\Dictionary\Enum;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewDictionaryCreated extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return Dictionary\Uuid
     */
    public function dictionaryUuid(): Dictionary\Uuid
    {
        return Dictionary\Uuid::fromString($this->aggregateId());
    }
    
    /**
     * @return Dictionary\Type
     */
    public function dictionaryType(): Dictionary\Type
    {
        return Dictionary\Type::fromString((string)($this->payload['type'] ?? Enum\Type::__default));
    }
    
    /**
     * @return Dictionary\Entries
     */
    public function dictionaryValues(): Dictionary\Entries
    {
        return Dictionary\Entries::fromArray((array)($this->payload['entries'] ? \unserialize($this->payload['entries'], ['allowed_classes' => false]) : []));
    }
    
    /**
     * @return Dictionary\BehavioursUuid
     */
    public function dictionaryBehaviours(): Dictionary\BehavioursUuid
    {
        return Dictionary\BehavioursUuid::fromArray((array)($this->payload['behaviours'] ? \unserialize($this->payload['behaviours'], ['allowed_classes' => false]) : []));
    }
    
    /**
     * @param Aggregate\AggregateRoot|Dictionary $dictionary
     */
    public function populate(Aggregate\AggregateRoot $dictionary): void
    {
        $dictionary->setUuid($this->dictionaryUuid());
        $dictionary->setType($this->dictionaryType());
        $dictionary->setEntries($this->dictionaryValues());
        $dictionary->setBehaviours($this->dictionaryBehaviours());
    }
}
