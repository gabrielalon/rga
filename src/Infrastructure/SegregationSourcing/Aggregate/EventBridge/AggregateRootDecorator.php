<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class AggregateRootDecorator extends AggregateRoot
{
    /**
     * @return AggregateRootDecorator
     */
    public static function newInstance(): self
    {
        return new static();
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @return int
     */
    public function extractAggregateVersion(AggregateRoot $aggregateRoot): int
    {
        return $aggregateRoot->version;
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return AggregateChanged[]
     */
    public function extractRecordedEvents(AggregateRoot $aggregateRoot): array
    {
        return $aggregateRoot->popRecordedEvents();
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @return string
     */
    public function extractAggregateId(AggregateRoot $aggregateRoot): string
    {
        return $aggregateRoot->aggregateId();
    }
    
    /**
     * @param string $aggregateRootClass
     * @param \Iterator $aggregateChangedEvents
     * @return AggregateRoot
     */
    public function fromHistory(string $aggregateRootClass, \Iterator $aggregateChangedEvents): AggregateRoot
    {
        if (false === class_exists($aggregateRootClass)) {
            throw new \RuntimeException(
                sprintf('Aggregate root class %s cannot be found', $aggregateRootClass)
            );
        }
        
        /** @var AggregateRoot $aggregateRootClass */
        
        return $aggregateRootClass::reconstituteFromHistory($aggregateChangedEvents);
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @param \Iterator $events
     */
    public function replayStreamEvents(AggregateRoot $aggregateRoot, \Iterator $events): void
    {
        $aggregateRoot->replay($events);
    }
    
    /**
     * @throws \BadMethodCallException
     */
    protected function aggregateId(): string
    {
        throw new \BadMethodCallException('The AggregateRootDecorator does not have an id');
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAggregateId($id): void
    {
    }
    
    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
    }
}
