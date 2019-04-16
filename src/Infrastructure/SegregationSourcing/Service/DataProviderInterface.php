<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

interface DataProviderInterface
{
    /**
     * @return integer|string
     */
    public function uuid();
    
    /**
     * @throws \Exception
     */
    public function verify(): void;
}
