<?php

namespace RGA\Test\Application\Rga\Command;

use RGA\Application\Rga\Command\ChangeNoteRga;
use RGA\Application\Rga\Event\NoteRgaChanged;
use RGA\Domain\Model\Rga\Projection\RgaProjectorInterface;
use RGA\Domain\Model\Rga\Rga;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Infrastructure\Projection\Rga\InMemoryRgaProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class ChangeNoteRgaHandlerTest
	extends CommandHandlerTestCase
{
	use CreateRgaHandlerTestTrait;
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_note_rga()
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
		$command = new ChangeNoteRga(
			$uuid->toString(),
			'test'
		);
		
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryRgaProjector $projector */
		$projector = $this->getFromContainer(RgaProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getAdminNotes()->toString(), 'test');
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NoteRgaChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($event->rgaAdminNotes()->toString(), 'test');
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Rga::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 2);
	}
}