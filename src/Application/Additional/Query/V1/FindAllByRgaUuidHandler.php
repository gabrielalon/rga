<?php

namespace RGA\Application\Additional\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByRgaUuidHandler extends AdditionalQueryHandler
{
    /**
     * @param MessageInterface|FindAllByRgaUuid $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAllByRgaUuid($query);
    }
}
