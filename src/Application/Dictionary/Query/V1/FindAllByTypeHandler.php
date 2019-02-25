<?php

namespace RGA\Application\Dictionary\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByTypeHandler
	extends DictionaryQueryHandler
{
	/**
	 * @param MessageInterface|FindAllByType $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findAllByType($query);
	}
}