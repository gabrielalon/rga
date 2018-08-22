<?php

namespace RGA\Domain\Model\Dictionary\Builder;

use RGA\Domain\Model\Dictionary\DictionaryLocale as Entity;
use RGA\Domain\ValueObject;

class DictionaryLocale
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
	 * @param string $entry
	 */
	public function setEntry($entry): void
	{
		$this->entity->setEntry(new ValueObject\Dictionary\Entry($entry));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}