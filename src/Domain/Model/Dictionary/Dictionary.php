<?php

namespace RGA\Domain\Model\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary as ValueObject;
use RGA\Application\Dictionary\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Dictionary extends Aggregate\AggregateRoot
{
    /** @var ValueObject\Uuid */
    protected $uuid;
    
    /** @var ValueObject\Type */
    protected $type;
    
    /** @var ValueObject\Entries */
    protected $entries;
    
    /** @var ValueObject\BehavioursUuid */
    protected $behaviours;
    
    /**
     * @param Dictionary\Uuid $uuid
     * @return Dictionary
     */
    public function setUuid(Dictionary\Uuid $uuid): Dictionary
    {
        $this->uuid = $uuid;
        
        return $this;
    }
    
    /**
     * @param Dictionary\Type $type
     * @return Dictionary
     */
    public function setType(Dictionary\Type $type): Dictionary
    {
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * @param Dictionary\Entries $entries
     * @return Dictionary
     */
    public function setEntries(Dictionary\Entries $entries): Dictionary
    {
        $this->entries = $entries;
        
        return $this;
    }
    
    /**
     * @param Dictionary\BehavioursUuid $behaviours
     * @return Dictionary
     */
    public function setBehaviours(Dictionary\BehavioursUuid $behaviours): Dictionary
    {
        $this->behaviours = $behaviours;
        
        return $this;
    }
    
    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->uuid->toString();
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAggregateId($id): void
    {
        $this->setUuid(Dictionary\Uuid::fromString($id));
    }
    
    /**
     * @param Dictionary\Uuid $uuid
     * @param Dictionary\Type $type
     * @param Dictionary\Entries $values
     * @param Dictionary\BehavioursUuid $behaviours
     * @return Dictionary
     */
    public static function createNewDictionary(
        ValueObject\Uuid $uuid,
        ValueObject\Type $type,
        ValueObject\Entries $values,
        ValueObject\BehavioursUuid $behaviours
    ): Dictionary {
        $dictionary = new Dictionary();
        
        $dictionary->recordThat(Event\NewDictionaryCreated::occur($uuid->toString(), [
            'type' => $type->toString(),
            'entries' => $values->toString(),
            'behaviours' => $behaviours->toString()
        ]));
        
        return $dictionary;
    }
    
    /**
     * @param Dictionary\Entries $values
     * @param Dictionary\BehavioursUuid $behaviours
     */
    public function changeExistingDictionary(
        ValueObject\Entries $values,
        ValueObject\BehavioursUuid $behaviours
    ): void {
        $this->recordThat(Event\ExistingDictionaryChanged::occur($this->aggregateId(), [
            'entries' => $values->toString(),
            'behaviours' => $behaviours->toString()
        ]));
    }
    
    public function removeExistingDictionary(): void
    {
        $this->recordThat(Event\ExistingDictionaryRemoved::occur($this->aggregateId(), []));
    }
}
