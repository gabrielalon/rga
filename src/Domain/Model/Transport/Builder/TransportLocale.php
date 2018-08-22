<?php

namespace RGA\Domain\Model\Transport\Builder;

use RGA\Domain\Model\Transport\TransportLocale as Entity;
use RGA\Domain\ValueObject;

class TransportLocale
{
	/** @var Entity */
	private $entity;
	
	/**
	 * @param string $locale
	 */
	public function __construct($locale)
	{
		$this->entity = new Entity();
		$this->entity->setLocale($locale);
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name): void
	{
		$this->entity->setName(new ValueObject\Transport\Name($name));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}