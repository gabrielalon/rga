<?php

namespace RGA\Test\Application;

use RGA\Infrastructure\SegregationSourcing\Aggregate;

abstract class AggregateChangedTestCase
	extends HandlerTestCase
{
	/** @var Aggregate\AggregateTranslator */
	private $aggregateTranslator;
	
	/**
	 * @param Aggregate\AggregateRoot $aggregateRoot
	 * @return array
	 */
	protected function popRecordedEvents(Aggregate\AggregateRoot $aggregateRoot): array
	{
		return $this->getAggregateTranslator()->extractPendingStreamEvents($aggregateRoot);
	}
	
	/**
	 * @param string $aggregateRootClass
	 * @param array $events
	 * @return Aggregate\AggregateRoot
	 */
	protected function reconstituteAggregateFromHistory(string $aggregateRootClass, array $events)
	{
		return $this->getAggregateTranslator()->reconstituteAggregateFromHistory(
			Aggregate\AggregateType::fromAggregateRootClass($aggregateRootClass),
			new \ArrayIterator($events)
		);
	}
	
	/**
	 * @return Aggregate\AggregateTranslator
	 */
	private function getAggregateTranslator(): Aggregate\AggregateTranslator
	{
		if (null === $this->aggregateTranslator)
		{
			$this->aggregateTranslator = Aggregate\AggregateTranslator::newInstance();
		}
		
		return $this->aggregateTranslator;
	}
}