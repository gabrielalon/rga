<?php

namespace RGA\Infrastructure\Projection\Attachment;

use RGA\Application\Attachment\Event;
use RGA\Domain\Model\Attachment\Projection;

class DummyAttachmentProjector
	implements Projection\AttachmentProjectorInterface
{
	/**
	 * @param Event\NewAttachmentCreated $event
	 */
	public function onNewAttachmentCreated(Event\NewAttachmentCreated $event): void
	{
		// TODO: Implement onNewAttachmentCreated() method.
	}
	
	/**
	 * @param Event\ExistingAttachmentRemoved $event
	 */
	public function onExistingAttachmentRemoved(Event\ExistingAttachmentRemoved $event): void
	{
		// TODO: Implement onExistingAttachmentRemoved() method.
	}
}