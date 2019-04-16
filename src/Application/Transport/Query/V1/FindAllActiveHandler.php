<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllActiveHandler extends TransportQueryHandler
{
    /**
     * @param MessageInterface|FindAllActive $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAllActive($query);
    }
}
