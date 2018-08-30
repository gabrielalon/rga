<?php

namespace RGA\Test\Domain\Model\Transport\Command;

use RGA\Application\Assert\Exception\AssertionFailedException;
use RGA\Domain\Model\Transport\Command\CreateTransport;
use RGA\Domain\Model\Transport\Event\NewTransportCreated;
use RGA\Domain\Model\Transport\Projection\TransportProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Transport\Projection\InMemoryTransportProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class CreateTransportHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_created_new_complaint_transport()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$domains = ['testowo.pl'];
		$names = ['pl' => 'Nazwa', 'en' => 'Name'];
		
		$command = new CreateTransport(
			$uuid->toString(),
			true,
			2,
			$domains,
			$names
		);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryTransportProjector $projector */
		$projector = $this->getFromContainer(TransportProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getActivation()->toString(), '1');
		$this->assertEquals($entity->getShipmentId()->toString(), '2');
		$this->assertEquals($entity->getDomains(), \json_encode($domains));
		$this->assertEquals($entity->getNames()->toString(), \json_encode($names));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewTransportCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getUuid()->equals($event->transportUuid()));
			$this->assertTrue($entity->getActivation()->equals($event->transportActivation()));
			$this->assertTrue($entity->getShipmentId()->equals($event->transportShipmentId()));
			$this->assertTrue($entity->getDomains()->equals($event->transportDomains()));
			$this->assertTrue($entity->getNames()->equals($event->transportNames()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 1);
	}
}