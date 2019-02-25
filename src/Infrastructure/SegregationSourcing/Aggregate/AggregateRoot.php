<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate;

use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;

abstract class AggregateRoot
{
	/** @var int */
	protected $version = 0;
	
	/** @var AggregateChanged[] */
	protected $recordedEvents = [];
	
	/**
	 * @return AggregateChanged[]
	 */
	protected function popRecordedEvents(): array
	{
		$pendingEvents = $this->recordedEvents;
		
		$this->recordedEvents = [];
		
		return $pendingEvents;
	}
	
	/**
	 * @param AggregateChanged $event
	 */
	protected function recordThat(AggregateChanged $event): void
	{
		++$this->version;
		
		$this->recordedEvents[] = $event->withVersion($this->version);
		
		$this->apply($event);
	}
	
	/**
	 * @param \Iterator $historyEvents
	 * @return AggregateRoot
	 */
	protected static function reconstituteFromHistory(\Iterator $historyEvents): self
	{
		$instance = new static();
		$instance->replay($historyEvents);
		
		return $instance;
	}
	
	/**
	 * @param \Iterator $historyEvents
	 */
	protected function replay(\Iterator $historyEvents): void
	{
		foreach ($historyEvents as $pastEvent)
		{
			/** @var AggregateChanged $pastEvent */
			$this->version = $pastEvent->version();
			
			$this->apply($pastEvent);
		}
	}
	
	/**
	 * @return string|integer
	 */
	abstract protected function aggregateId();
	
	/**
	 * @param string|integer $id
	 */
	abstract public function setAggregateId($id): void;
	
	/**
	 * @param AggregateChanged $event
	 */
	protected function apply(AggregateChanged $event): void
	{
		$event->populate($this);
	}
}