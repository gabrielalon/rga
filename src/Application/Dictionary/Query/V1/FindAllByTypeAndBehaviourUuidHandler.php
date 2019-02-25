<?php

namespace RGA\Application\Dictionary\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByTypeAndBehaviourUuidHandler
	extends DictionaryQueryHandler
{
	/**
	 * @param MessageInterface|FindAllByTypeAndBehaviourUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findAllByTypeAndBehaviourUuid($query);
	}
}