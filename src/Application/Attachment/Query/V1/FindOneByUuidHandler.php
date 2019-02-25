<?php

namespace RGA\Application\Attachment\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByUuidHandler
	extends AttachmentQueryHandler
{
	
	/**
	 * @param MessageInterface|FindOneByUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByUuid($query);
	}
}