<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByRgaUuidHandler
	extends StateQueryHandler
{
	/**
	 * @param MessageInterface|FindOneByRgaUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByRgaUuid($query);
	}
}