<?php

namespace RGA\Domain\Model\Transport\Builder;

use RGA\Domain\Model\Transport\TransportAlias as Entity;
use RGA\Domain\ValueObject;

class TransportAlias
{
	/** @var Entity */
	private $entity;
	
	public function __construct()
	{
		$this->entity = new Entity();
	}
	
	/**
	 * @param string $alias
	 */
	public function setName($alias): void
	{
		$this->entity->setName(new ValueObject\Transport\Alias($alias));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}