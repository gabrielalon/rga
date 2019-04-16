<?php

namespace RGA\Application\Behaviour\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByTypeHandler extends BehaviourQueryHandler
{
    /**
     * @param MessageInterface|FindOneByType $query
     */
    public function run(MessageInterface $query): void
    {
        $this->repository->findOneByType($query);
    }
}
