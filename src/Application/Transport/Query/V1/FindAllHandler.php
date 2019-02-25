<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllHandler
	extends TransportQueryHandler
{
	/**
	 * @param MessageInterface|FindAll $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findAll($query);
	}
}