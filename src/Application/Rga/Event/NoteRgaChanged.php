<?php

namespace RGA\Application\Rga\Event;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class NoteRgaChanged extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return ValueObject\AdminNotes
     */
    public function rgaAdminNotes(): ValueObject\AdminNotes
    {
        return ValueObject\AdminNotes::fromString((string)($this->payload['admin_notes'] ?? ''));
    }
    
    /**
     * @param AggregateRoot|Rga $rga
     */
    public function populate(AggregateRoot $rga): void
    {
        $rga->setAdminNotes($this->rgaAdminNotes());
    }
}
