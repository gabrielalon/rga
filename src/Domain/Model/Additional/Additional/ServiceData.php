<?php

namespace RGA\Domain\Model\Additional\Additional;

final class ServiceData
{
    /** @var array */
    private $serviceData;
    
    /**
     * @param array $serviceData
     * @return ServiceData
     */
    public static function fromArray(array $serviceData = []): ServiceData
    {
        return new ServiceData($serviceData);
    }
    
    /**
     * @param array $serviceData
     */
    private function __construct(array $serviceData = [])
    {
        $this->serviceData = $serviceData;
    }
    
    /**
     * @return array
     */
    public function raw(): array
    {
        return $this->serviceData;
    }
    
    /**
     * @param ServiceData $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ServiceData) {
            return false;
        }
        
        return $this->serviceData === $other->serviceData;
    }
}
