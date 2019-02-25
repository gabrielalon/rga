<?php

namespace RGA\Application\ReturnPackage\Event;

use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewReturnPackageCreated
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return ReturnPackage\Id
	 */
	public function returnPackageId(): ReturnPackage\Id
	{
		return ReturnPackage\Id::fromInteger((int)$this->aggregateId());
	}
	
	/**
	 * @return ReturnPackage\RgaUuid
	 */
	public function returnPackageRgaUuid(): ReturnPackage\RgaUuid
	{
		return ReturnPackage\RgaUuid::fromString((string)($this->payload['rga_uuid'] ?? ''));
	}
	
	/**
	 * @return ReturnPackage\TransportUuid
	 */
	public function returnPackageTransportUuid(): ReturnPackage\TransportUuid
	{
		return ReturnPackage\TransportUuid::fromString((string)($this->payload['transport_uuid'] ?? ''));
	}
	
	/**
	 * @return ReturnPackage\NettPrice
	 */
	public function returnPackageNettPrice(): ReturnPackage\NettPrice
	{
		return ReturnPackage\NettPrice::fromFloat((float)($this->payload['nett_price'] ?? 0));
	}
	
	/**
	 * @return ReturnPackage\VatRate
	 */
	public function returnPackageVatRate(): ReturnPackage\VatRate
	{
		return ReturnPackage\VatRate::fromInteger((int)($this->payload['vat_rate'] ?? 0));
	}
	
	/**
	 * @return ReturnPackage\Currency
	 */
	public function returnPackageCurrency(): ReturnPackage\Currency
	{
		return ReturnPackage\Currency::fromString((string)($this->payload['currency'] ?? 'PLN'));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|ReturnPackage $returnPackage
	 */
	public function populate(Aggregate\AggregateRoot $returnPackage): void
	{
		$returnPackage->setId($this->returnPackageId());
		$returnPackage->setRgaUuid($this->returnPackageRgaUuid());
		$returnPackage->setTransportUuid($this->returnPackageTransportUuid());
		$returnPackage->setNettPrice($this->returnPackageNettPrice());
		$returnPackage->setVatRate($this->returnPackageVatRate());
		$returnPackage->setCurrency($this->returnPackageCurrency());
	}
}