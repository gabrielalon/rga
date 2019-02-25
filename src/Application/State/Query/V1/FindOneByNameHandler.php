<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByNameHandler
	extends StateQueryHandler
{
	/**
	 * @param MessageInterface|FindOneByName $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByName($query);
	}
}