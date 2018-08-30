<?php

namespace RGA\Test\Domain\Model\Attachment\Command;

use RGA\Application\Assert\Exception\AssertionFailedException;
use RGA\Domain\Model\Attachment\Command\CreateAttachment;
use RGA\Domain\Model\Attachment\Event\NewAttachmentCreated;
use RGA\Domain\Model\Attachment\Projection\AttachmentProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Attachment\Projection\InMemoryAttachmentProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

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
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
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
			
			$this->assertTrue($entity->getUuid()->equals($event->attachmentUuid()));
			$this->assertTrue($entity->getRgaUuid()->equals($event->attachmentRgaUuid()));
			$this->assertTrue($entity->getFileType()->equals($event->attachmentFileType()));
			$this->assertTrue($entity->getFileName()->equals($event->attachmentFileName()));
			$this->assertTrue($entity->getOriginalFileName()->equals($event->attachmentOriginalFileName()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 1);
	}
}