<?php

namespace RGA\Infrastructure\Query\Source;

use RGA\Application\Source\Query\GetOne;
use RGA\Application\Source\Query\RgaObjectQueryInterface;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Infrastructure\Source\RgaObjectQuery\ObjectQueryInterface;
use RGA\Infrastructure\Source\Service\Baser64;
use RGA\Infrastructure\Source\Service\BaserInterface;
use RGA\Infrastructure\Source\Service\StandardService;

class RgaObjectQuery
	implements RgaObjectQueryInterface
{
	/** @var BaserInterface */
	private $baser;
	
	/** @var ObjectQueryInterface */
	private $objectQuery;
	
	/**
	 * @param BaserInterface $baser
	 * @param ObjectQueryInterface $objectQuery
	 */
	public function __construct(BaserInterface $baser, ObjectQueryInterface $objectQuery)
	{
		$this->baser = $baser;
		$this->objectQuery = $objectQuery;
	}
	
	/**
	 * @param GetOne $query
	 */
	public function getOne(GetOne $query): void
	{
		try
		{
			$encodedId = $this->baser->encode($query->getId());
			/** @var RgaObject $object */
			$object = $this->objectQuery->getByObjectInfo($query->getType(), $encodedId);
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