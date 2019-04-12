<?php

namespace RGA\Infrastructure\Source\RgaObjectQuery;

use RGA\Infrastructure\Source\Registry\RegistryInterface;
use RGA\Infrastructure\Source\RgaObject;

class StandardQuery
	implements ObjectQueryInterface
{
	/** @var RegistryInterface */
	private $registry;
	
	/**
	 * @param RegistryInterface $registry
	 */
	public function __construct(RegistryInterface $registry)
	{
		$this->registry = $registry;
	}
	
	/**
	 * @param string $objectType
	 * @param string $encodedObjectId
	 * @return RgaObject\RgaObjectInterface
	 * @throws \Exception
	 */
	public function getByObjectInfo($objectType, $encodedObjectId): RgaObject\RgaObjectInterface
	{
		$typeService = $this->registry->get($objectType);
		
		if (null === $typeService)
		{
			throw new \Exception('Service for object type "' . $objectType . '" not found');
		}
		
		return $typeService->buildObject($encodedObjectId);
	}
	
	/**
	 * @param string $objectType
	 * @param integer $objectId
	 * @return RgaObject\RgaObjectItemInterface
	 * @throws \Exception
	 */
	public function getByObjectItemInfo($objectType, $objectId): RgaObject\RgaObjectItemInterface
	{
		$typeService = $this->registry->get($objectType);
		
		if (null === $typeService)
		{
			throw new \Exception('Service for object type "' . $objectType . '" not found');
		}
		
		return $typeService->buildObjectItem($objectId);
	}
}