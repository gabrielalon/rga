<?php

namespace RGA\Application\Source\Registry;

use RGA\Infrastructure\Source\Registry;
use RGA\Infrastructure\Source\Service;
use function sprintf;

class StandardRegistry
	implements Registry\RegistryInterface
{
	/** @var Service\ServiceInterface[] */
	private $items;
	
	/**
	 * @param string $objectType
	 * @return Service\ServiceInterface
	 * @throws \InvalidArgumentException
	 */
	public function get($objectType)
	{
		if (true === isset($this->items[$objectType]))
		{
			return $this->items[$objectType];
		}
		
		throw new \InvalidArgumentException(sprintf(
			'RGA Source Service not found for object type: %s',
			$objectType
		));
	}
	
	/**
	 * @param Service\ServiceInterface $service
	 */
	public function put(Service\ServiceInterface $service)
	{
		$this->items[$service->sourceType()] = $service;
	}
	
	/**
	 * @return Service\ServiceInterface[]
	 */
	public function all()
	{
		return $this->items;
	}
}