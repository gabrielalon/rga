<?php

namespace RGA\Application\Transport\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateTransport implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var boolean */
    private $isActive;
    
    /** @var integer */
    private $shipmentId;
    
    /** @var array */
    private $domains;
    
    /** @var array */
    private $names;
    
    /**
     * @param string $uuid
     * @param bool $isActive
     * @param int $shipmentId
     * @param array $domains
     * @param array $names
     */
    public function __construct(
        string $uuid,
        bool $isActive,
        int $shipmentId,
        array $domains,
        array $names
    ) {
        $this->setIdentifier($uuid);
        $this->isActive = $isActive;
        $this->shipmentId = $shipmentId;
        $this->domains = $domains;
        $this->names = $names;
    }
    
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }
    
    /**
     * @return int
     */
    public function getShipmentId(): int
    {
        return $this->shipmentId;
    }
    
    /**
     * @return array
     */
    public function getDomains(): array
    {
        return $this->domains;
    }
    
    /**
     * @return array
     */
    public function getNames(): array
    {
        return $this->names;
    }
}
