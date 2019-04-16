<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByHashHandler extends RgaQueryHandler
{
    /**
     * @param MessageInterface|FindOneByHash $query
     */
    public function run(MessageInterface $query)
    {
        $this->repository->findOneByHash($query);
    }
}
