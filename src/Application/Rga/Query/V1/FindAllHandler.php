<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindAllHandler
	extends RgaQueryHandler
{
	
	/**
	 * @param MessageInterface|FindAll $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findAll($query);
	}
}