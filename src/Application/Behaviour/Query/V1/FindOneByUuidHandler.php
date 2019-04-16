<?php

namespace RGA\Application\Behaviour\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByUuidHandler extends BehaviourQueryHandler
{
    /**
     * @param MessageInterface|FindOneByUuid $query
     */
    public function run(MessageInterface $query): void
    {
        $this->repository->findOneByUuid($query);
    }
}
