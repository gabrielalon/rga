<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByUuidHandler
	extends StateQueryHandler
{
	/**
	 * @param MessageInterface|FindOneByUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByUuid($query);
	}
}