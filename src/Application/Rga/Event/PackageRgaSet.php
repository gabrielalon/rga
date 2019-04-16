<?php

namespace RGA\Application\Rga\Event;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class PackageRgaSet extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return ValueObject\PackageNo
     */
    public function rgaPackageNo(): ValueObject\PackageNo
    {
        return ValueObject\PackageNo::fromString((string)($this->payload['package_no'] ?? ''));
    }
    
    /**
     * @return ValueObject\PackageSentAt
     */
    public function rgaPackageSentAt(): ValueObject\PackageSentAt
    {
        return ValueObject\PackageSentAt::fromString((string)($this->payload['package_sent_at'] ?? ''));
    }
    
    /**
     * @param AggregateRoot|Rga $rga
     */
    public function populate(AggregateRoot $rga): void
    {
        $rga->setPackageNo($this->rgaPackageNo());
        $rga->setPackageSentAt($this->rgaPackageSentAt());
        $rga->setPackageSent(Rga\PackageSent::fromBoolean(true));
    }
}
