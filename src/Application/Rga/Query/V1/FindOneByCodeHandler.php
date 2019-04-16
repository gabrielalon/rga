<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByCodeHandler extends RgaQueryHandler
{
    
    /**
     * @param MessageInterface|FindOneByCode $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findOneByCode($query);
    }
}
