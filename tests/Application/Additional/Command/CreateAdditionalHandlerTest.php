<?php

namespace RGA\Test\Application\Additional\Command;

use RGA\Domain\Model\Additional\Additional;
use RGA\Application\Additional\Command\CreateAdditional;
use RGA\Application\Additional\Event\NewAdditionalCreated;
use RGA\Domain\Model\Additional\Projection\AdditionalProjectorInterface;
use RGA\Infrastructure\Projection\Additional\InMemoryAdditionalProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class CreateAdditionalHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_created_new_complaint_additional()
	{
		//given
		$rgaUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		
		$command = new CreateAdditional(
			$rgaUuid,
			'test',
			['test']
		);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryAdditionalProjector $projector */
		$projector = $this->getFromContainer(AdditionalProjectorInterface::class);
		$entity = $projector->get($rgaUuid);
		
		$this->assertEquals($entity->getRgaUuid()->toString(), $rgaUuid);
		$this->assertEquals($entity->getServiceType()->toString(), 'test');
		$this->assertEquals($entity->getServiceData()->raw(), ['test']);
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($rgaUuid, 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewAdditionalCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getRgaUuid()->equals($event->additionalRgaUuid()));
			$this->assertTrue($entity->getServiceType()->equals($event->additionalServiceType()));
			$this->assertTrue($entity->getServiceData()->equals($event->additionalServiceData()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Additional::class), $rgaUuid);
		
		$this->assertEquals($snapshot->getVersion(), 1);
	}
}