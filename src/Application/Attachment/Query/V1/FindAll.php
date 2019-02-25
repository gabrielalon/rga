<?php

namespace RGA\Application\Attachment\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindAll
	extends QueryMessage
{
	/** @var int */
	private $page;
	
	/** @var int */
	private $limit;
	
	/**
	 * @param int $page
	 * @param int $limit
	 */
	public function __construct(int $page, int $limit)
	{
		$this->page = $page;
		$this->limit = $limit;
		$this->init();
	}
	
	/**
	 * @return int
	 */
	public function getPage(): int
	{
		return $this->page;
	}
	
	/**
	 * @return int
	 */
	public function getLimit(): int
	{
		return $this->limit;
	}
}