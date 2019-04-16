<?php

namespace RGA\Domain\Model\Additional;

use RGA\Domain\Model\Additional\Additional as ValueObject;
use RGA\Application\Additional\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Additional extends Aggregate\AggregateRoot
{
    /** @var ValueObject\RgaUuid */
    protected $rgaUuid;
    
    /** @var ValueObject\ServiceType */
    protected $serviceType;
    
    /** @var ValueObject\ServiceData */
    protected $serviceData;
    
    /**
     * @param Additional\RgaUuid $rgaUuid
     * @return Additional
     */
    public function setRgaUuid(Additional\RgaUuid $rgaUuid): self
    {
        $this->rgaUuid = $rgaUuid;
        
        return $this;
    }
    
    /**
     * @param Additional\ServiceType $serviceType
     * @return Additional
     */
    public function setServiceType(Additional\ServiceType $serviceType): self
    {
        $this->serviceType = $serviceType;
        
        return $this;
    }
    
    /**
     * @param Additional\ServiceData $serviceData
     * @return Additional
     */
    public function setServiceData(Additional\ServiceData $serviceData): self
    {
        $this->serviceData = $serviceData;
        
        return $this;
    }
    
    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->rgaUuid->toString();
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAggregateId($id): void
    {
        $this->setRgaUuid(Additional\RgaUuid::fromString($id));
    }
    
    /**
     * @param Additional\RgaUuid $rgaUuid
     * @param Additional\ServiceType $serviceType
     * @param Additional\ServiceData $serviceData
     * @return Additional
     */
    public static function createNewAdditional(
        ValueObject\RgaUuid $rgaUuid,
        ValueObject\ServiceType $serviceType,
        ValueObject\ServiceData $serviceData
    ): Additional {
        $additional = new Additional();
        
        $additional->recordThat(Event\NewAdditionalCreated::occur($rgaUuid->toString(), [
            'rga_uuid'     => $rgaUuid->toString(),
            'service_type' => $serviceType->toString(),
            'service_data' => $serviceData->raw(),
        ]));
        
        return $additional;
    }
}
