<?php

namespace RGA\Domain\Model\ReturnPackage;

use RGA\Domain\Model\ReturnPackage\ReturnPackage as ValueObject;
use RGA\Domain\Model\ReturnPackage\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ReturnPackage
	extends Aggregate\AggregateRoot
{
	/** @var ValueObject\Id */
	private $id;
	
	/** @var ValueObject\RgaUuid */
	private $rgaUuid;
	
	/** @var ValueObject\TransportUuid */
	private $transportUuid;
	
	/** @var ValueObject\NettPrice */
	private $nettPrice;
	
	/** @var ValueObject\VatRate */
	private $vatRate;
	
	/** @var ValueObject\Currency */
	private $currency;
	
	/** @var ValueObject\PackageSent */
	private $packageSent;
	
	/** @var ValueObject\PackageNo */
	private $packageNo;
	
	/** @var ValueObject\PackageSentAt */
	private $packageSentAt;
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->id->toString();
	}
	
	/**
	 * @param ValueObject\Id $id
	 */
	public function setId(ValueObject\Id $id): void
	{
		$this->id = $id;
	}
	
	/**
	 * @param ValueObject\RgaUuid $rgaUuid
	 */
	public function setRgaUuid(ValueObject\RgaUuid $rgaUuid): void
	{
		$this->rgaUuid = $rgaUuid;
	}
	
	/**
	 * @param ValueObject\TransportUuid $transportUuid
	 */
	public function setTransportUuid(ValueObject\TransportUuid $transportUuid): void
	{
		$this->transportUuid = $transportUuid;
	}
	
	/**
	 * @param ValueObject\NettPrice $nettPrice
	 */
	public function setNettPrice(ValueObject\NettPrice $nettPrice): void
	{
		$this->nettPrice = $nettPrice;
	}
	
	/**
	 * @param ValueObject\VatRate $vatRate
	 */
	public function setVatRate(ValueObject\VatRate $vatRate): void
	{
		$this->vatRate = $vatRate;
	}
	
	/**
	 * @param ValueObject\Currency $currency
	 */
	public function setCurrency(ValueObject\Currency $currency): void
	{
		$this->currency = $currency;
	}
	
	/**
	 * @param ValueObject\PackageSent $packageSent
	 */
	public function setPackageSent(ValueObject\PackageSent $packageSent): void
	{
		$this->packageSent = $packageSent;
	}
	
	/**
	 * @param ValueObject\PackageNo $packageNo
	 */
	public function setPackageNo(ValueObject\PackageNo $packageNo): void
	{
		$this->packageNo = $packageNo;
	}
	
	/**
	 * @param ValueObject\PackageSentAt $packageSentAt
	 */
	public function setPackageSentAt(ValueObject\PackageSentAt $packageSentAt): void
	{
		$this->packageSentAt = $packageSentAt;
	}
	
	/**
	 * @param ValueObject\Id $id
	 * @param ValueObject\RgaUuid $rgaUuid
	 * @param ValueObject\TransportUuid $transportUuid
	 * @param ValueObject\NettPrice $nettPrice
	 * @param ValueObject\VatRate $vatRate
	 * @param ValueObject\Currency $currency
	 * @return ReturnPackage
	 */
	public static function createNewReturnPackage(
		ValueObject\Id $id,
		ValueObject\RgaUuid $rgaUuid,
		ValueObject\TransportUuid $transportUuid,
		ValueObject\NettPrice $nettPrice,
		ValueObject\VatRate $vatRate,
		ValueObject\Currency $currency
		
	): ReturnPackage
	{
		$returnPackage = new ReturnPackage();
		
		$returnPackage->recordThat(Event\NewReturnPackageCreated::occur($id->toString(), [
			'rga_uuid' => $rgaUuid->toString(),
			'transport_uuid' => $transportUuid->toString(),
			'nett_price' => $nettPrice->toString(),
			'vat_rate' => $vatRate->toString(),
			'currency' => $currency->toString()
		]));
		
		return $returnPackage;
	}
	
	/**
	 * @param ValueObject\PackageNo $packageNo
	 * @param ValueObject\PackageSentAt $packageSentAt
	 */
	public function setReturnPackage(
		ValueObject\PackageNo $packageNo,
		ValueObject\PackageSentAt $packageSentAt
	): void
	{
		$this->recordThat(Event\ReturnPackageSet::occur($this->aggregateId(), [
			'package_no' => $packageNo->toString(),
			'package_sent_at' => $packageSentAt->toString()
		]));
	}
}