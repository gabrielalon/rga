<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneByIndividualNumber extends QueryMessage
{
    /** @var integer */
    private $individualNumber;
    
    /**
     * @param int $individualNumber
     */
    public function __construct(int $individualNumber)
    {
        $this->individualNumber = $individualNumber;
        $this->init();
    }
    
    /**
     * @return int
     */
    public function getIndividualNumber(): int
    {
        return $this->individualNumber;
    }
}
