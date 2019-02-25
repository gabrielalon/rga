<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByUuidHandler
	extends RgaQueryHandler
{
	
	/**
	 * @param MessageInterface|FindOneByUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByUuid($query);
	}
}