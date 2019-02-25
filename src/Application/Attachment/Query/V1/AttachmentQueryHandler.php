<?php

namespace RGA\Application\Attachment\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class AttachmentQueryHandler
	implements QueryHandlerInterface
{
	/** @var AttachmentQueryInterface */
	protected $repository;
	
	/**
	 * @param AttachmentQueryInterface $repository
	 */
	public function __construct(AttachmentQueryInterface $repository)
	{
		$this->repository = $repository;
	}
}