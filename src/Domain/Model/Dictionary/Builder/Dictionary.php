<?php

namespace RGA\Domain\Model\Dictionary\Builder;

use RGA\Domain\Model\Dictionary\Dictionary as Entity;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate\LocaleCollector;

class Dictionary
{
	/** @var Entity */
	private $entity;

	/**
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}

	/**
	 * @param string $uuid
	 * @return Dictionary
	 */
	public static function init($uuid): Dictionary
	{
		$entity = new Entity();
		$entity->setUuid($uuid);
		
		return new Dictionary($entity);
	}
	
	/**
	 * @param string $type
	 */
	public function setType($type): void
	{
		$this->entity->setType(new ValueObject\Dictionary\Type($type));
	}
	
	/**
	 * @param boolean $isDeletable
	 */
	public function setIsDeletable($isDeletable): void
	{
		$this->entity->setIsDeletable(new ValueObject\Dictionary\IsDeletable($isDeletable));
	}
	
	/**
	 * @param array $entries
	 */
	public function setEntries($entries = []): void
	{
		$locales = new LocaleCollector();
		
		foreach ($entries as $locale => $entry)
		{
			$builder = new DictionaryLocale($locale);
			$builder->setEntry($entry);

			$locales->add($builder->build());
		}

		$this->entity->setLocales($locales);
	}

	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}