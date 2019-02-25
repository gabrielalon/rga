<?php

namespace RGA\Application\Dictionary\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByUuidHandler
	extends DictionaryQueryHandler
{
	/**
	 * @param MessageInterface|FindOneByUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByUuid($query);
	}
}