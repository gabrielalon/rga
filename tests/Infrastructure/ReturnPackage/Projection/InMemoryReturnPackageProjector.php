<?php

namespace RGA\Test\Infrastructure\ReturnPackage\Projection;

use RGA\Domain\Model\ReturnPackage\Event;
use RGA\Domain\Model\ReturnPackage\Projection\ReturnPackageProjectorInterface;
use RGA\Test\Mock\Entity\ReturnPackage\ReturnPackage;

class InMemoryReturnPackageProjector
	implements ReturnPackageProjectorInterface
{
	/** @var ReturnPackage[] */
	private $entities = [];
	
	/**
	 * @param Event\NewReturnPackageCreated $event
	 */
	public function onNewReturnPackageCreated(Event\NewReturnPackageCreated $event): void
	{
		$this->entities[$event->aggregateId()] = (new ReturnPackage())
			->setId($event->returnPackageId())
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
	 * @return ReturnPackage
	 */
	public function get(int $id): ReturnPackage
	{
		if (false === isset($this->entities[$id]))
		{
			throw new \RuntimeException('ReturnPackage entity not found for uuid: ' . $id);
		}
		
		return $this->entities[$id];
	}
}