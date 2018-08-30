<?php

namespace RGA\Test\Domain\Model\Attachment\Command;

use RGA\Domain\Model\Attachment\Command\CreateAttachment;
use RGA\Domain\Model\Attachment\Command\RemoveAttachment;
use RGA\Domain\Model\Attachment\Event\ExistingAttachmentRemoved;
use RGA\Domain\Model\Attachment\Projection\AttachmentProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Attachment\Projection\InMemoryAttachmentProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class RemoveAttachmentHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_removes_existing_attachment()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$rgaUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		
		$command = new CreateAttachment(
			$uuid->toString(),
			$rgaUuid,
			'test',
			'test',
			'test'
		);
		$this->getCommandBus()->dispatch($command);
		
		//when
		$command = new RemoveAttachment($uuid->toString());
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryAttachmentProjector $projector */
		$projector = $this->getFromContainer(AttachmentProjectorInterface::class);
		$this->expectException(\RuntimeException::class);
		$projector->get($uuid->toString());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingAttachmentRemoved $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($uuid->toString(), $event->aggregateId());
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}