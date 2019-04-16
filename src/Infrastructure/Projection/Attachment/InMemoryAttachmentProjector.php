<?php

namespace RGA\Infrastructure\Projection\Attachment;

use RGA\Application\Attachment\Event;
use RGA\Application\Attachment\Query\ReadModel;
use RGA\Domain\Model\Attachment\Projection\AttachmentProjectorInterface;

class InMemoryAttachmentProjector implements AttachmentProjectorInterface
{
    /** @var ReadModel\Attachment[] */
    private $attachments = [];
    
    /**
     * @param Event\NewAttachmentCreated $event
     */
    public function onNewAttachmentCreated(Event\NewAttachmentCreated $event): void
    {
        $this->attachments[$event->attachmentUuid()->toString()] = ReadModel\Attachment::fromUuid($event->attachmentUuid())
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
     * @return ReadModel\Attachment
     */
    public function get(string $uuid): ReadModel\Attachment
    {
        if (false === isset($this->attachments[$uuid])) {
            throw new \RuntimeException('Attachment entity not found for uuid: ' . $uuid);
        }
        
        return $this->attachments[$uuid];
    }
}
