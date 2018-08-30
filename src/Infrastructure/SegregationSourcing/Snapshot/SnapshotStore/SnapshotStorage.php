<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore;

use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot\Snapshot;

class SnapshotStorage
{
	use Aggregate\AggregateTranslatorTrait;
	
	/** @var SnapshotRepositoryInterface */
	private $snapshotRepository;
	
	/** @var SerializerInterface */
	private $serializer;
	
	/**
	 * @param SnapshotRepositoryInterface $snapshotRepository
	 */
	public function __construct(SnapshotRepositoryInterface $snapshotRepository)
	{
		$this->snapshotRepository = $snapshotRepository;
		$this->serializer = new CallbackSerializer(null, null);
	}
	
	/**
	 * @param Aggregate\AggregateRoot $aggregateRoot
	 */
	public function make(Aggregate\AggregateRoot $aggregateRoot): void
	{
		$snapshot = new Snapshot(
			Aggregate\AggregateType::fromAggregateRoot($aggregateRoot),
			$this->getAggregateTranslator()->extractAggregateId($aggregateRoot),
			$this->serializer->serialize($aggregateRoot),
			$this->getAggregateTranslator()->extractAggregateVersion($aggregateRoot),
			new \DateTime('now')
		);
		
		$this->snapshotRepository->save($snapshot);
	}
	
	/**
	 * @param Aggregate\AggregateType $aggregateType
	 * @param string $aggregateId
	 * @return Snapshot
	 */
	public function get(Aggregate\AggregateType $aggregateType, string $aggregateId): Snapshot
	{
		$result = $this->snapshotRepository->get($aggregateId);
		
		$snapshot = new Snapshot(
			$aggregateType,
			$aggregateId,
			'',
			0,
			new \DateTime('now')
		);
		
		if (true === \is_array($result) && false === empty($result))
		{
			$snapshot = new Snapshot(
				$aggregateType,
				$aggregateId,
				$this->serializer->unserialize($result['aggregate_root']),
				$result['aggregate_version'],
				$result['created_at']
			);
		}
		
		return $snapshot;
	}
}