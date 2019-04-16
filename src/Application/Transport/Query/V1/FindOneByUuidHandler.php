<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByUuidHandler extends TransportQueryHandler
{
    /**
     * @param MessageInterface|FindOneByUuid $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findOneByUuid($query);
    }
}
