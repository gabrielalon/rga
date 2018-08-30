<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\Command;

trait CommandTrait
{
	/** @var string */
	protected $uuid;
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @param string $uuid
	 */
	public function setUuid(string $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @return string
	 */
	public function messageName(): string
	{
		return \get_class($this);
	}
}