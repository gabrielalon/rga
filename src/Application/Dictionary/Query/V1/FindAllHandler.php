<?php

namespace RGA\Application\Dictionary\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllHandler extends DictionaryQueryHandler
{
    /**
     * @param MessageInterface|FindAll $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAll($query);
    }
}
