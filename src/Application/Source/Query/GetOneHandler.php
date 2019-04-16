<?php

namespace RGA\Application\Source\Query;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

class GetOneHandler implements QueryHandlerInterface
{
    /** @var RgaObjectQueryInterface */
    protected $repository;
    
    /**
     * @param RgaObjectQueryInterface $repository
     */
    public function __construct(RgaObjectQueryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param MessageInterface|GetOne $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->getOne($query);
    }
}
