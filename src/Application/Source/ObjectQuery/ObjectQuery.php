<?php

namespace RGA\Application\Source\ObjectQuery;

use RGA\Infrastructure\Source\Object;
use RGA\Infrastructure\Source\ObjectQuery\ObjectQueryInterface;
use RGA\Infrastructure\Source\Registry;
use RGA\Infrastructure\Source\Service;

class ObjectQuery
	implements ObjectQueryInterface
{
	/** @var Registry\RegistryInterface */
	private $registry;
	
	/**
	 * @param Registry\RegistryInterface $registry
	 */
	public function __construct(Registry\RegistryInterface $registry)
	{
		$this->registry = $registry;
	}
	
	/**
	 * @param string $type
	 * @param integer $id
	 * @return Object\ObjectInterface
	 * @throws \RuntimeException
	 */
	public function getByObjectInfo($type, $id)
	{
		/** @var Service\ServiceInterface $service */
		$service = $this->registry->get($type);
		
		return $service->buildObject($id);
	}
	
	/**
	 * @param $objectType
	 * @param $objectId
	 * @return Object\ObjectItemInterface
	 * @throws \Exception
	 */
	public function getByObjectItemInfo($type, $itemId)
	{
		/** @var Service\ServiceInterface $service */
		$service = $this->registry->get($type);
		
		return $service->buildObjectItem($itemId);
	}
}