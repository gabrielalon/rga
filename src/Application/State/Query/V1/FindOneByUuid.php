<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneByUuid
	extends QueryMessage
{
	/** @var string */
	private $uuid;
	
	/**
	 * @param string $uuid
	 */
	public function __construct(string $uuid)
	{
		$this->uuid = $uuid;
		$this->init();
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
}