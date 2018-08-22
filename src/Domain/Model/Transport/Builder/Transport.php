<?php

namespace RGA\Domain\Model\Transport\Builder;

use RGA\Domain\Model\Transport\Transport as Entity;
use RGA\Domain\Model\Transport\TransportAliasCollector;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class Transport
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
	 * @return Transport
	 */
	public static function init($uuid): Transport
	{
		$entity = new Entity();
		$entity->setUuid($uuid);
		
		return new Transport($entity);
	}
	
	/**
	 * @param boolean $isActive
	 */
	public function setIsActive($isActive): void
	{
		$this->entity->setIsActive(new ValueObject\Transport\IsActive($isActive));
	}
	
	/**
	 * @param string $courierSymbol
	 */
	public function setCourierSymbol($courierSymbol): void
	{
		$this->entity->setCourierSymbol(new ValueObject\Transport\CourierSymbol($courierSymbol));
	}
	
	/**
	 * @param array $names
	 */
	public function setNames(array $names = []): void
	{
		$locales = new Translate\LocaleCollector();
		
		foreach ($names as $locale => $name)
		{
			$builder = new TransportLocale($locale);
			$builder->setName($name);
			
			$locales->add($builder->build());
		}
		
		$this->entity->setLocales($locales);
	}
	
	/**
	 * @param array $aliases
	 */
	public function setAliases(array $aliases = []): void
	{
		$collection = new TransportAliasCollector();
		
		foreach ($aliases as $alias)
		{
			$builder = new TransportAlias();
			$builder->setName($alias);
			
			$collection->add($builder->build());
		}
		
		$this->entity->setAliases($collection);
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}