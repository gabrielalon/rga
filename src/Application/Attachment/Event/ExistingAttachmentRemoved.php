<?php

namespace RGA\Application\Attachment\Event;

use RGA\Domain\Model\Attachment\Attachment;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingAttachmentRemoved extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @param Aggregate\AggregateRoot|Attachment $attachment
     */
    public function populate(Aggregate\AggregateRoot $attachment): void
    {
        // no need to do anything
    }
}
