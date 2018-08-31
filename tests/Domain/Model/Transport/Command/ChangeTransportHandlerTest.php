<?php

namespace RGA\Test\Domain\Model\Dictionary\Command;

use RGA\Domain\Model\Transport\Command\ChangeTransport;
use RGA\Domain\Model\Transport\Command\CreateTransport;
use RGA\Domain\Model\Transport\Event\ExistingTransportChanged;
use RGA\Domain\Model\Transport\Projection\TransportProjectorInterface;
use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Transport\Projection\InMemoryTransportProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class ChangeTransportHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_existing_complaint_transport()
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
		$domains = ['test.pl'];
		$names = ['pl' => 'Nazwa test', 'en' => 'Name test'];
		$command = new ChangeTransport(
			$uuid->toString(),
			false,
			2,
			$domains,
			$names
		);
		
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryTransportProjector $projector */
		$projector = $this->getFromContainer(TransportProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getActivation()->toString(), '0');
		$this->assertEquals($entity->getShipmentId()->toString(), '2');
		$this->assertEquals($entity->getDomains(), \serialize($domains));
		$this->assertEquals($entity->getNames()->toString(), \serialize($names));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingTransportChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($entity->getUuid()->toString(), $event->aggregateId());
			$this->assertTrue($entity->getActivation()->equals($event->transportActivation()));
			$this->assertTrue($entity->getShipmentId()->equals($event->transportShipmentId()));
			$this->assertTrue($entity->getDomains()->equals($event->transportDomains()));
			$this->assertTrue($entity->getNames()->equals($event->transportNames()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Transport::class), $uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}