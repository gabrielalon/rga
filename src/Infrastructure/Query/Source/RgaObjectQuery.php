<?php

namespace RGA\Infrastructure\Query\Source;

use RGA\Application\Source\Query\GetOne;
use RGA\Application\Source\Query\RgaObjectQueryInterface;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Infrastructure\Source\RgaObjectQuery\ObjectQueryInterface;
use RGA\Infrastructure\Source\Service\Baser64;
use RGA\Infrastructure\Source\Service\StandardService;

class RgaObjectQuery
	implements RgaObjectQueryInterface
{
	/** @var ObjectQueryInterface */
	private $objectQuery;
	
	/**
	 * @param ObjectQueryInterface $objectQuery
	 */
	public function __construct(ObjectQueryInterface $objectQuery)
	{
		$this->objectQuery = $objectQuery;
	}
	
	/**
	 * @param GetOne $query
	 */
	public function getOne(GetOne $query): void
	{
		try
		{
			/** @var RgaObject $object */
			$object = $this->objectQuery->getByObjectInfo($query->getType(), $query->getId());
		}
		catch (\Exception $e)
		{
			$sourceService = new StandardService(new Baser64());
			/** @var RgaObject $object */
			$object = $sourceService->buildObject($query->getGivenId());
		}
		
		$query->setObject($object);
	}
}