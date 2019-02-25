<?php

namespace RGA\Test\Application\Attachment;

use RGA\Domain\Model\Attachment\Attachment as ValueObject;
use RGA\Domain\Model\Attachment\Attachment;
use RGA\Application\Attachment\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Application\AggregateChangedTestCase;

class AttachmentTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\RgaUuid */
	private $rgaUuid;
	
	/** @var ValueObject\FileType */
	private $fileType;
	
	/** @var ValueObject\FileName */
	private $fileName;
	
	/** @var ValueObject\OriginalFileName */
	private $originalFileName;
	
	protected function setUp()
	{
		$this->uuid = ValueObject\Uuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->rgaUuid = ValueObject\RgaUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->fileType = ValueObject\FileType::fromString('test');
		$this->fileName = ValueObject\FileName::fromString('test');
		$this->originalFileName = ValueObject\OriginalFileName::fromString('test');
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_attachment()
	{
		$attachment = Attachment::createNewAttachment(
			$this->uuid,
			$this->rgaUuid,
			$this->fileType,
			$this->fileName,
			$this->originalFileName
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($attachment);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewAttachmentCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewAttachmentCreated::class, $event->messageName());
		$this->assertTrue($this->uuid->equals($event->attachmentUuid()));
		$this->assertTrue($this->rgaUuid->equals($event->attachmentRgaUuid()));
		$this->assertTrue($this->fileType->equals($event->attachmentFileType()));
		$this->assertTrue($this->fileName->equals($event->attachmentFileName()));
		$this->assertTrue($this->originalFileName->equals($event->attachmentOriginalFileName()));
	}
}