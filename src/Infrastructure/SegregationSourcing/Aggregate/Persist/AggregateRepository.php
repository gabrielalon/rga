<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate\Persist;

use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\EventStorage;
use RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage;

abstract class AggregateRepository
{
	use Aggregate\AggregateTranslatorTrait;
	
	/** @var Aggregate\AggregateType */
	protected $aggregateType;
	
	/** @var EventStorage */
	protected $eventStorage;
	
	/** @var SnapshotStorage */
	protected $snapshotStorage;
	
	/**
	 * @param EventStorage $eventStorage
	 * @param SnapshotStorage $snapshotStorage
	 */
	public function __construct(EventStorage $eventStorage, SnapshotStorage $snapshotStorage)
	{
		$this->eventStorage = $eventStorage;
		$this->snapshotStorage = $snapshotStorage;
		
		$this->initAggregateType();
	}
	
	/**
	 * @return string
	 */
	abstract public function getAggregateRootClass(): string;
	
	private function initAggregateType(): void
	{
		$this->aggregateType = Aggregate\AggregateType::fromAggregateRootClass($this->getAggregateRootClass());
	}
	
	/**
	 * @param Aggregate\AggregateRoot $aggregateRoot
	 */
	protected function saveAggregateRoot(Aggregate\AggregateRoot $aggregateRoot): void
	{
		/** @var Aggregate\EventBridge\AggregateChanged $aggregateChanged */
		foreach ($this->getAggregateTranslator()->extractPendingStreamEvents($aggregateRoot) as $aggregateChanged)
		{
			$this->eventStorage->release($aggregateChanged)->record();
		}
		
		$this->snapshotStorage->make($aggregateRoot);
	}
	
	/**
	 * @param string $aggregateId
	 * @return Aggregate\AggregateRoot
	 */
	protected function findAggregateRoot(string $aggregateId): Aggregate\AggregateRoot
	{
		$snapshot = $this->snapshotStorage->get($this->aggregateType, $aggregateId);
		
		$aggregateRoot = $snapshot->getAggregateRoot();
		$events = $this->eventStorage->load($aggregateId, $snapshot->getLastVersion() + 1);
		
		if ($aggregateRoot instanceof Aggregate\AggregateRoot)
		{
			$this->getAggregateTranslator()
				->replayStreamEvents($aggregateRoot, $events);
		}
		else
		{
			$aggregateRoot = $this->getAggregateTranslator()
				->reconstituteAggregateFromHistory($this->aggregateType, $events);
		}
		
		return $aggregateRoot;
	}
}