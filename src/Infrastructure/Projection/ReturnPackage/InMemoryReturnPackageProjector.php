<?php

namespace RGA\Infrastructure\Projection\ReturnPackage;

use RGA\Application\ReturnPackage\Event;
use RGA\Application\ReturnPackage\Query\ReadModel;
use RGA\Domain\Model\ReturnPackage\Projection\ReturnPackageProjectorInterface;

class InMemoryReturnPackageProjector
	implements ReturnPackageProjectorInterface
{
	/** @var ReadModel\ReturnPackage[] */
	private $entities = [];
	
	/**
	 * @param Event\NewReturnPackageCreated $event
	 */
	public function onNewReturnPackageCreated(Event\NewReturnPackageCreated $event): void
	{
		$this->entities[$event->aggregateId()] = ReadModel\ReturnPackage::fromId($event->aggregateId())
			->setRgaUuid($event->returnPackageRgaUuid())
			->setTransportUuid($event->returnPackageTransportUuid())
			->setNettPrice($event->returnPackageNettPrice())
			->setVatRate($event->returnPackageVatRate())
			->setCurrency($event->returnPackageCurrency());
	}
	
	/**
	 * @param Event\ReturnPackageSet $event
	 */
	public function onReturnPackageSet(Event\ReturnPackageSet $event): void
	{
		$this->entities[$event->aggregateId()] = $this->get($event->aggregateId())
			->setPackageNo($event->returnPackageNo())
			->setPackageSentAt($event->returnPackageSentAt());
	}
	
	/**
	 * @param integer $id
	 * @return ReadModel\ReturnPackage
	 */
	public function get(int $id): ReadModel\ReturnPackage
	{
		if (false === isset($this->entities[$id]))
		{
			throw new \RuntimeException('ReturnPackage entity not found for uuid: ' . $id);
		}
		
		return $this->entities[$id];
	}
}