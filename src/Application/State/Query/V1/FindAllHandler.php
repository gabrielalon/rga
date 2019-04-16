<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllHandler extends StateQueryHandler
{
    /**
     * @param MessageInterface|FindAll $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAll($query);
    }
}
