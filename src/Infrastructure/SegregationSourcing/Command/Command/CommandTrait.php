<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\Command;

trait CommandTrait
{
	/** @var string|integer */
	protected $identifier;
	
	/**
	 * @return string|integer
	 */
	public function getIdentifier()
	{
		return $this->identifier;
	}
	
	/**
	 * @param string|integer $identifier
	 */
	public function setIdentifier($identifier)
	{
		$this->identifier = $identifier;
	}
	
	/**
	 * @return string
	 */
	public function messageName()
	{
		return get_class($this);
	}
}