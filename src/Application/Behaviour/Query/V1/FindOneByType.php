<?php

namespace RGA\Application\Behaviour\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindOneByType
	extends QueryMessage
{
	/** @var string */
	private $type;
	
	/**
	 * @param string $type
	 */
	public function __construct(string $type)
	{
		$this->type = $type;
		$this->init();
	}
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}