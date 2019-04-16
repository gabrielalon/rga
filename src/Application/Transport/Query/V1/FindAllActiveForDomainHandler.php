<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllActiveForDomainHandler extends TransportQueryHandler
{
    /**
     * @param MessageInterface|FindAllActiveForDomain $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAllActiveForDomain($query);
    }
}
