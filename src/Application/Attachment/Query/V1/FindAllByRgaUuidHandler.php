<?php

namespace RGA\Application\Attachment\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByRgaUuidHandler
	extends AttachmentQueryHandler
{
	/**
	 * @param MessageInterface|FindAllByRgaUuid $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findAllByRgaUuid($query);
	}
}