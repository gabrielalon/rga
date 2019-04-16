<?php

namespace RGA\Domain\Model\Transport;

use RGA\Domain\Model\Transport\Transport as VO;
use RGA\Application\Transport\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Transport extends Aggregate\AggregateRoot
{
    /** @var VO\Uuid */
    protected $uuid;
    
    /** @var VO\Active */
    protected $active;
    
    /** @var VO\ShipmentId */
    protected $shipmentId;
    
    /** @var VO\Domains */
    protected $domains;
    
    /** @var VO\Names */
    protected $names;
    
    /**
     * @param Transport\Uuid $uuid
     * @return Transport
     */
    public function setUuid(Transport\Uuid $uuid): Transport
    {
        $this->uuid = $uuid;
        
        return $this;
    }
    
    /**
     * @param Transport\Active $active
     * @return Transport
     */
    public function setActivation(Transport\Active $active): Transport
    {
        $this->active = $active;
        
        return $this;
    }
    
    /**
     * @param Transport\ShipmentId $shipmentId
     * @return Transport
     */
    public function setShipmentId(Transport\ShipmentId $shipmentId): Transport
    {
        $this->shipmentId = $shipmentId;
        
        return $this;
    }
    
    /**
     * @param Transport\Domains $domains
     * @return Transport
     */
    public function setDomains(Transport\Domains $domains): Transport
    {
        $this->domains = $domains;
        
        return $this;
    }
    
    /**
     * @param Transport\Names $names
     * @return Transport
     */
    public function setNames(Transport\Names $names): Transport
    {
        $this->names = $names;
        
        return $this;
    }
    
    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->uuid->toString();
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAggregateId($id): void
    {
        $this->setUuid(VO\Uuid::fromString($id));
    }
    
    /**
     * @param Transport\Uuid $uuid
     * @param Transport\Active $activation
     * @param Transport\ShipmentId $shipmentId
     * @param Transport\Domains $domains
     * @param Transport\Names $names
     * @return Transport
     */
    public static function createNewTransport(
        VO\Uuid $uuid,
        VO\Active $activation,
        VO\ShipmentId $shipmentId,
        VO\Domains $domains,
        VO\Names $names
    ): Transport {
        $transport = new Transport();
        
        $transport->recordThat(Event\NewTransportCreated::occur($uuid->toString(), [
            'activation'  => $activation->toString(),
            'shipment_id' => $shipmentId->toString(),
            'domains'     => $domains->toString(),
            'names'       => $names->toString()
        ]));
        
        return $transport;
    }
    
    /**
     * @param Transport\Active $activation
     * @param Transport\ShipmentId $shipmentId
     * @param Transport\Domains $domains
     * @param Transport\Names $names
     */
    public function changeExistingTransport(
        VO\Active $activation,
        VO\ShipmentId $shipmentId,
        VO\Domains $domains,
        VO\Names $names
    ): void {
        $this->recordThat(Event\ExistingTransportChanged::occur($this->aggregateId(), [
            'activation'  => $activation->toString(),
            'shipment_id' => $shipmentId->toString(),
            'domains'     => $domains->toString(),
            'names'       => $names->toString()
        ]));
    }
    
    public function removeExistingTransport(): void
    {
        $this->recordThat(Event\ExistingTransportRemoved::occur($this->aggregateId(), []));
    }
}
