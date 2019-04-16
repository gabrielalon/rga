<?php

namespace RGA\Infrastructure\Source\Registry;

use RGA\Infrastructure\Source\Service;

class StandardRegistry implements RegistryInterface
{
    /** @var Service\ServiceInterface[] */
    private $items;
    
    /**
     * @param string $objectType
     * @return Service\ServiceInterface
     * @throws \InvalidArgumentException
     */
    public function get($objectType): Service\ServiceInterface
    {
        if (true === isset($this->items[$objectType])) {
            return $this->items[$objectType];
        }
        
        throw new \InvalidArgumentException(\sprintf(
            'RGA Source Service not found for object type: %s',
            $objectType
        ));
    }
    
    /**
     * @param Service\ServiceInterface $service
     */
    public function put(Service\ServiceInterface $service)
    {
        $this->items[$service->sourceType()] = $service;
    }
    
    /**
     * @return Service\ServiceInterface[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
