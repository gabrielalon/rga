<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate;

use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateRootDecorator;

class AggregateTranslator
{
    /** @var AggregateRootDecorator */
    protected $aggregateRootDecorator;
    
    /**
     * @return AggregateTranslator
     */
    public static function newInstance(): AggregateTranslator
    {
        return new self();
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @return int
     */
    public function extractAggregateVersion(AggregateRoot $aggregateRoot): int
    {
        return $this->getAggregateRootDecorator()->extractAggregateVersion($aggregateRoot);
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @return string
     */
    public function extractAggregateId(AggregateRoot $aggregateRoot): string
    {
        return $this->getAggregateRootDecorator()->extractAggregateId($aggregateRoot);
    }
    
    /**
     * @param AggregateType $aggregateType
     * @param \Iterator $historyEvents
     * @return AggregateRoot
     */
    public function reconstituteAggregateFromHistory(AggregateType $aggregateType, \Iterator $historyEvents): AggregateRoot
    {
        return $this->getAggregateRootDecorator()
            ->fromHistory($aggregateType->getAggregateType(), $historyEvents);
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @return AggregateChanged[]
     */
    public function extractPendingStreamEvents(AggregateRoot $aggregateRoot): array
    {
        return $this->getAggregateRootDecorator()
            ->extractRecordedEvents($aggregateRoot);
    }
    
    /**
     * @param AggregateRoot $aggregateRoot
     * @param \Iterator $events
     */
    public function replayStreamEvents(AggregateRoot $aggregateRoot, \Iterator $events): void
    {
        $this->getAggregateRootDecorator()->replayStreamEvents($aggregateRoot, $events);
    }
    
    /**
     * @return AggregateRootDecorator
     */
    public function getAggregateRootDecorator(): AggregateRootDecorator
    {
        if (null === $this->aggregateRootDecorator) {
            $this->aggregateRootDecorator = AggregateRootDecorator::newInstance();
        }
        
        return $this->aggregateRootDecorator;
    }
}
