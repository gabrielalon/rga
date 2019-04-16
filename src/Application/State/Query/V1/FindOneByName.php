<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneByName extends QueryMessage
{
    /** @var array */
    private $name;
    
    /**
     * @param array $name
     */
    public function __construct(array $name)
    {
        $this->name = $name;
        $this->init();
    }
    
    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->name;
    }
}
