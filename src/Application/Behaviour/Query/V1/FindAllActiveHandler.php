<?php

namespace RGA\Application\Behaviour\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllActiveHandler extends BehaviourQueryHandler
{
    /**
     * @param MessageInterface|FindAllActive $query
     */
    public function run(MessageInterface $query): void
    {
        $this->repository->findAllActive($query);
    }
}
