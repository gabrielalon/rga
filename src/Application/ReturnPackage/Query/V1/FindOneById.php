<?php

namespace RGA\Application\ReturnPackage\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneById extends QueryMessage
{
    /** @var int|string */
    private $id;
    
    /**
     * @param int|string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->init();
    }
    
    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }
}
