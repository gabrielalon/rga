<?php

namespace RGA\Domain\Model\Behaviour\Builder;

use RGA\Domain\Model\Behaviour\BehaviourLocale as Entity;
use RGA\Domain\ValueObject;

class BehaviourLocale
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
		$this->entity->setName(new ValueObject\Behaviour\Name($name));
	}
	
	/**
	 * @return Entity
	 */
	public function build()
	{
		return $this->entity;
	}
}