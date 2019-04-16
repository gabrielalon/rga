<?php

namespace RGA\Application\ReturnPackage\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByRgaUuidHandler extends ReturnPackageQueryHandler
{
    /**
     * @param MessageInterface|FindAllByRgaUuid $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findAllByRgaUuid($query);
    }
}
