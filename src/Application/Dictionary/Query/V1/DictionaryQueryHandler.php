<?php

namespace RGA\Application\Dictionary\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class DictionaryQueryHandler implements QueryHandlerInterface
{
    /** @var DictionaryQueryInterface */
    protected $repository;
    
    /**
     * @param DictionaryQueryInterface $repository
     */
    public function __construct(DictionaryQueryInterface $repository)
    {
        $this->repository = $repository;
    }
}
