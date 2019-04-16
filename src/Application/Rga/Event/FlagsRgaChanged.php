<?php

namespace RGA\Application\Rga\Event;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class FlagsRgaChanged extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return ValueObject\IsProductReceived
     */
    public function rgaIsProductReceived(): ValueObject\IsProductReceived
    {
        return ValueObject\IsProductReceived::fromBoolean((bool)($this->payload['is_product_received'] ?? ''));
    }
    
    /**
     * @return ValueObject\IsCashReturned
     */
    public function rgaIsCashReturned(): ValueObject\IsCashReturned
    {
        return ValueObject\IsCashReturned::fromBoolean((bool)($this->payload['is_cash_returned'] ?? ''));
    }
    
    /**
     * @return ValueObject\IsProductReturned
     */
    public function rgaIsProductReturned(): ValueObject\IsProductReturned
    {
        return ValueObject\IsProductReturned::fromBoolean((bool)($this->payload['is_product_returned'] ?? ''));
    }
    
    /**
     * @return ValueObject\AdminNotesForApplicant
     */
    public function rgaAdminNotesForApplicant(): ValueObject\AdminNotesForApplicant
    {
        return ValueObject\AdminNotesForApplicant::fromString((string)($this->payload['admin_notes_for_applicant'] ?? ''));
    }
    
    /**
     * @param AggregateRoot|Rga $rga
     */
    public function populate(AggregateRoot $rga): void
    {
        $rga->setAdminNotesForApplicant($this->rgaAdminNotesForApplicant());
        
        $rga->setIsProductReturned($this->rgaIsProductReturned());
        $rga->setIsProductReceived($this->rgaIsProductReceived());
        $rga->setIsCashReturned($this->rgaIsCashReturned());
    }
}
