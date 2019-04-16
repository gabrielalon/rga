<?php

namespace RGA\Application\Additional\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateAdditional implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var string */
    private $serviceType;
    
    /** @var array */
    private $serviceData;
    
    /**
     * @param string $rgaUuid
     * @param string $serviceType
     * @param array $serviceData
     */
    public function __construct(string $rgaUuid, string $serviceType, array $serviceData)
    {
        $this->setIdentifier($rgaUuid);
        $this->serviceType = $serviceType;
        $this->serviceData = $serviceData;
    }
    
    /**
     * @return string
     */
    public function getRgaUuid(): string
    {
        return $this->getIdentifier();
    }
    
    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }
    
    /**
     * @return array
     */
    public function getServiceData(): array
    {
        return $this->serviceData;
    }
}
