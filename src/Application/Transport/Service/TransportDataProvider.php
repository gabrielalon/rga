<?php

namespace RGA\Application\Transport\Service;

use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface TransportDataProvider extends DataProviderInterface
{
    /**
     * @return bool
     */
    public function activation(): bool;
    
    /**
     * @return integer
     */
    public function shipmentId(): int;
    
    /**
     * @return array
     */
    public function names(): array;
    
    /**
     * @return array
     */
    public function domains(): array;
}
