<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindAllActiveForDomain
	extends QueryMessage
{
	/** @var string */
	private $domain;
	
	/**
	 * @param string $domain
	 */
	public function __construct(string $domain)
	{
		$this->domain = $domain;
		$this->init();
	}
	
	/**
	 * @return string
	 */
	public function getDomain(): string
	{
		return $this->domain;
	}
}