<?php

namespace RGA\Application\Attachment\Service;

use RGA\Application\Attachment\Command;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractCommandManager;

class AttachmentCommandManager extends AbstractCommandManager
{
    /**
     * @param AttachmentDataProvider $provider
     */
    public function create(AttachmentDataProvider $provider): void
    {
        $this->handle(new Command\CreateAttachment(
            $provider->uuid(),
            $provider->rgaUuid(),
            $provider->fileType(),
            $provider->fileName(),
            $provider->originalFileName()
        ));
    }
    
    /**
     * @param string $uuid
     */
    public function remove(string $uuid): void
    {
        $this->handle(new Command\RemoveAttachment($uuid));
    }
}
