<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneByHash extends QueryMessage
{
    /** @var string */
    private $hash;
    
    /**
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
        $this->init();
    }
    
    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}
