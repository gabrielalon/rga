<?php

namespace RGA\Application\Rga\Event;

use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class ExistingRgaRemoved extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return Rga\IsDeleted
     */
    public function rgaIsDeleted(): Rga\IsDeleted
    {
        return Rga\IsDeleted::fromBoolean((bool)($this->payload['is_deleted'] ?? ''));
    }
    
    /**
     * @param AggregateRoot|Rga $rga
     */
    public function populate(AggregateRoot $rga): void
    {
        $rga->setIsDeleted($this->rgaIsDeleted());
    }
}
