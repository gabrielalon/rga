<?php

namespace RGA\Application\ReturnPackage\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByIdHandler
	extends ReturnPackageQueryHandler
{
	/**
	 * @param MessageInterface|FindOneById $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneById($query);
	}
}