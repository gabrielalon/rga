<?php

namespace RGA\Test\Infrastructure\Attachment\Projection;

use RGA\Domain\Model\Attachment\Event;
use RGA\Domain\Model\Attachment\Projection\AttachmentProjectorInterface;
use RGA\Test\Mock\Entity\Attachment\Attachment;

class InMemoryAttachmentProjector
	implements AttachmentProjectorInterface
{
	/** @var Attachment[] */
	private $attachments = [];
	
	/**
	 * @param Event\NewAttachmentCreated $event
	 */
	public function onNewAttachmentCreated(Event\NewAttachmentCreated $event): void
	{
		$this->attachments[$event->attachmentUuid()->toString()] = (new Attachment())
			->setUuid($event->attachmentUuid())
			->setRgaUuid($event->attachmentRgaUuid())
			->setFileType($event->attachmentFileType())
			->setFileName($event->attachmentFileName())
			->setOriginalFileName($event->attachmentOriginalFileName());
	}
	
	/**
	 * @param Event\ExistingAttachmentRemoved $event
	 */
	public function onExistingAttachmentRemoved(Event\ExistingAttachmentRemoved $event): void
	{
		unset($this->attachments[$event->aggregateId()]);
	}
	
	/**
	 * @param string $uuid
	 * @return Attachment
	 */
	public function get(string $uuid): Attachment
	{
		if (false === isset($this->attachments[$uuid]))
		{
			throw new \RuntimeException('Attachment entity not found for uuid: ' . $uuid);
		}
		
		return $this->attachments[$uuid];
	}
}