<?php

namespace RGA\Domain\Model\Attachment\Projection;

use RGA\Application\Attachment\Event;

interface AttachmentProjectorInterface
{
    /**
     * @param Event\NewAttachmentCreated $event
     */
    public function onNewAttachmentCreated(Event\NewAttachmentCreated $event): void;
    
    /**
     * @param Event\ExistingAttachmentRemoved $event
     */
    public function onExistingAttachmentRemoved(Event\ExistingAttachmentRemoved $event): void;
}
