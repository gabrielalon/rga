<?php

namespace RGA\Application\Attachment\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllHandler extends AttachmentQueryHandler
{
    /**
     * @param MessageInterface|FindAll $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAll($query);
    }
}
