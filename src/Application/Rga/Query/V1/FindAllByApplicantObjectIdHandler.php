<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllByApplicantObjectIdHandler extends RgaQueryHandler
{
	/**
	 * @param MessageInterface|FindAllByApplicantObjectId $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findAllByApplicantObjectId($query);
	}
}