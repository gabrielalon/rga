<?php

namespace RGA\Test\Domain\Model\Transport\Command;

use RGA\Domain\Model\Transport\Command\CreateTransport;
use RGA\Domain\Model\Transport\Command\RemoveTransport;
use RGA\Domain\Model\Transport\Event\ExistingTransportChanged;
use RGA\Domain\Model\Transport\Event\ExistingTransportRemoved;
use RGA\Domain\Model\Transport\Projection\TransportProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Transport\Projection\InMemoryTransportProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class RemoveTransportHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_removes_existing_transport()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$domains = ['testowo.pl'];
		$names = ['pl' => 'Nazwa', 'en' => 'Name'];
		
		$command = new CreateTransport(
			$uuid->toString(),
			true,
			1,
			$domains,
			$names
		);
		$this->getCommandBus()->dispatch($command);
		
		//when
		$command = new RemoveTransport($uuid->toString());
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryTransportProjector $projector */
		$projector = $this->getFromContainer(TransportProjectorInterface::class);
		$this->expectException(\RuntimeException::class);
		$projector->get($uuid->toString());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingTransportRemoved $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($uuid->toString(), $event->aggregateId());
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}