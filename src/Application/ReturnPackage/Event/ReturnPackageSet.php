<?php

namespace RGA\Application\ReturnPackage\Event;

use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class ReturnPackageSet extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return ReturnPackage\PackageNo
     */
    public function returnPackageNo(): ReturnPackage\PackageNo
    {
        return ReturnPackage\PackageNo::fromString((string)($this->payload['package_no'] ?? ''));
    }
    
    /**
     * @return ReturnPackage\PackageSentAt
     */
    public function returnPackageSentAt(): ReturnPackage\PackageSentAt
    {
        return ReturnPackage\PackageSentAt::fromString((string)($this->payload['package_sent_at'] ?? ''));
    }
    
    /**
     * @param AggregateRoot|ReturnPackage $returnPackage
     */
    public function populate(AggregateRoot $returnPackage): void
    {
        $returnPackage->setPackageNo($this->returnPackageNo());
        $returnPackage->setPackageSentAt($this->returnPackageSentAt());
        $returnPackage->setPackageSent(ReturnPackage\PackageSent::fromBoolean(true));
    }
}
