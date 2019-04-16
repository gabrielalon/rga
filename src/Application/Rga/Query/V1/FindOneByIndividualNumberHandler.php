<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByIndividualNumberHandler extends RgaQueryHandler
{
    
    /**
     * @param MessageInterface|FindOneByIndividualNumber $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findOneByIndividualNumber($query);
    }
}
