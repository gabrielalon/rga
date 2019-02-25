<?php

namespace RGA\Test\Application\Attachment\Command;

use RGA\Domain\Model\Attachment\Attachment;
use RGA\Application\Attachment\Command\CreateAttachment;
use RGA\Application\Attachment\Event\NewAttachmentCreated;
use RGA\Domain\Model\Attachment\Projection\AttachmentProjectorInterface;
use RGA\Infrastructure\Projection\Attachment\InMemoryAttachmentProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class CreateAttachmentHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_created_new_complaint_attachment()
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
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryAttachmentProjector $projector */
		$projector = $this->getFromContainer(AttachmentProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getIdentifier()->toString(), $uuid->toString());
		$this->assertEquals($entity->getRgaUuid()->toString(), $rgaUuid);
		$this->assertEquals($entity->getFileType()->toString(), 'test');
		$this->assertEquals($entity->getFileName()->toString(), 'test');
		$this->assertEquals($entity->getOriginalFileName()->toString(), 'test');
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewAttachmentCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getIdentifier()->equals($event->attachmentUuid()));
			$this->assertTrue($entity->getRgaUuid()->equals($event->attachmentRgaUuid()));
			$this->assertTrue($entity->getFileType()->equals($event->attachmentFileType()));
			$this->assertTrue($entity->getFileName()->equals($event->attachmentFileName()));
			$this->assertTrue($entity->getOriginalFileName()->equals($event->attachmentOriginalFileName()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Attachment::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 1);
	}
}