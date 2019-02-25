<?php

namespace RGA\Application\Behaviour\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllHandler
	extends BehaviourQueryHandler
{
	/**
	 * @param MessageInterface|FindAll $query
	 */
	public function run(MessageInterface $query): void
	{
		$this->repository->findAll($query);
	}
}