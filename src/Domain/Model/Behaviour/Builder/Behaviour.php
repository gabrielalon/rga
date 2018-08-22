<?php

namespace RGA\Domain\Model\Behaviour\Builder;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\Model\Behaviour\Behaviour as Entity;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class Behaviour
{
	/** @var Entity */
	private $entity;

	/**
	 * @param Entity $model
	 */
	public function __construct(Entity $model)
	{
		$this->entity = $model;
	}

	/**
	 * @param string $uuid
	 * @return Behaviour
	 */
	public static function init($uuid)
	{
		$entity = new Entity();
		$entity->setUuid($uuid);
		
		return new Behaviour($entity);
	}
	
	/**
	 * @param boolean $isActive
	 */
	public function setIsActive($isActive): void
	{
		$this->entity->setIsActive(new ValueObject\Behaviour\IsActive($isActive));
	}

	/**
	 * @param string $type
	 */
	public function setType($type): void
	{
		$this->entity->setType(new ValueObject\Behaviour\Type($type));
	}

	/**
	 * @param array $names
	 */
	public function setNames($names = []): void
	{
		$locales = new Translate\LocaleCollector();
		
		foreach ($names as $locale => $name)
		{
			$builder = new BehaviourLocale($locale);
			$builder->setName($name);

			$locales->add($builder->build());
		}

		$this->entity->setLocales($locales);
	}
	
	/**
	 * @return Entity
	 */
	public function build()
	{
		return $this->entity;
	}
}