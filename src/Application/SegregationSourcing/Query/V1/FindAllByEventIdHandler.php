<?php

namespace RGA\Application\SegregationSourcing\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByEventIdHandler extends StorageEventQueryHandler
{
    /**
     * @param MessageInterface|FindAllByEventId $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAllByEventId($query);
    }
}
