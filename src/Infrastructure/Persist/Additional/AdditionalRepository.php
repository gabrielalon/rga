<?php

namespace RGA\Infrastructure\Persist\Additional;

use RGA\Domain\Model\Additional\Additional;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class AdditionalRepository extends AggregateRepository
{
    /**
     * @return string
     */
    public function getAggregateRootClass(): string
    {
        return Additional::class;
    }
    
    /**
     * @param Additional $Additional
     */
    public function save(Additional $Additional): void
    {
        $this->saveAggregateRoot($Additional);
    }
    
    /**
     * @param string $uuid
     * @return Additional
     */
    public function find(string $uuid): Additional
    {
        /** @var Additional $Additional */
        $Additional = $this->findAggregateRoot($uuid);
        
        return $Additional;
    }
}
