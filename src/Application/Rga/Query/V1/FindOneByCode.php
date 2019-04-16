<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneByCode extends QueryMessage
{
    /** @var string */
    private $code;
    
    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
        $this->init();
    }
    
    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
