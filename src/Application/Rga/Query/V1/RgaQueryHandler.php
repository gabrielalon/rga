<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class RgaQueryHandler
	implements QueryHandlerInterface
{
	/** @var RgaQueryInterface */
	protected $repository;
	
	/**
	 * @param RgaQueryInterface $repository
	 */
	public function __construct(RgaQueryInterface $repository)
	{
		$this->repository = $repository;
	}
}