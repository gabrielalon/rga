<?php

namespace RGA\Test\Domain\Model\Rga\Command;

use RGA\Domain\Model\Rga\Command\ChangeFlagsRga;
use RGA\Domain\Model\Rga\Event\FlagsRgaChanged;
use RGA\Domain\Model\Rga\Projection\RgaProjectorInterface;
use RGA\Domain\Model\Rga\Rga;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Rga\Projection\InMemoryRgaProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class ChangeFlagsRgaHandlerTest
	extends CommandHandlerTestCase
{
	use CreateRgaHandlerTestTrait;
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_flags_rga()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		/** @var RgaObject $sourceObject */
		$sourceObject = $this->sourceService->buildObject($this->sourceService->orderID);
		/** @var RgaObjectItem $sourceObjectItem */
		$sourceObjectItem = $sourceObject->getItems()->current();
		$command = $this->getCreateCommand($uuid, $sourceObject, $sourceObjectItem);
		$this->getCommandBus()->dispatch($command);
		
		//when
		$command = new ChangeFlagsRga(
			$uuid->toString(),
			true,
			true,
			true,
			'test'
		);
		
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryRgaProjector $projector */
		$projector = $this->getFromContainer(RgaProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getIsProductReceived()->toString(), '1');
		$this->assertEquals($entity->getIsCashReturned()->toString(), '1');
		$this->assertEquals($entity->getIsProductReturned()->toString(), '1');
		$this->assertEquals($entity->getAdminNotesForApplicant()->toString(), 'test');
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var FlagsRgaChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($event->rgaIsProductReceived()->toString(), '1');
			$this->assertEquals($event->rgaIsCashReturned()->toString(), '1');
			$this->assertEquals($event->rgaIsProductReturned()->toString(), '1');
			$this->assertEquals($event->rgaAdminNotesForApplicant()->toString(), 'test');
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Rga::class), $uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}