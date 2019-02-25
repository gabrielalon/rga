<?php

namespace RGA\Domain\Model\ReturnPackage;

use RGA\Domain\Model\ReturnPackage\ReturnPackage as VO;
use RGA\Application\ReturnPackage\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ReturnPackage
	extends Aggregate\AggregateRoot
{
	/** @var VO\Id */
	protected $id;
	
	/** @var VO\RgaUuid */
	protected $rgaUuid;
	
	/** @var VO\TransportUuid */
	protected $transportUuid;
	
	/** @var VO\NettPrice */
	protected $nettPrice;
	
	/** @var VO\VatRate */
	protected $vatRate;
	
	/** @var VO\Currency */
	protected $currency;
	
	/** @var VO\PackageSent */
	protected $packageSent;
	
	/** @var VO\PackageNo */
	protected $packageNo;
	
	/** @var VO\PackageSentAt */
	protected $packageSentAt;
	
	/**
	 * @param VO\Id $id
	 * @return ReturnPackage
	 */
	public function setId(VO\Id $id): ReturnPackage
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * @param VO\RgaUuid $rgaUuid
	 * @return ReturnPackage
	 */
	public function setRgaUuid(VO\RgaUuid $rgaUuid): ReturnPackage
	{
		$this->rgaUuid = $rgaUuid;
		
		return $this;
	}
	
	/**
	 * @param VO\TransportUuid $transportUuid
	 * @return ReturnPackage
	 */
	public function setTransportUuid(VO\TransportUuid $transportUuid): ReturnPackage
	{
		$this->transportUuid = $transportUuid;
		
		return $this;
	}
	
	/**
	 * @param VO\NettPrice $nettPrice
	 * @return ReturnPackage
	 */
	public function setNettPrice(VO\NettPrice $nettPrice): ReturnPackage
	{
		$this->nettPrice = $nettPrice;
		
		return $this;
	}
	
	/**
	 * @param VO\VatRate $vatRate
	 * @return ReturnPackage
	 */
	public function setVatRate(VO\VatRate $vatRate): ReturnPackage
	{
		$this->vatRate = $vatRate;
		
		return $this;
	}
	
	/**
	 * @param VO\Currency $currency
	 * @return ReturnPackage
	 */
	public function setCurrency(VO\Currency $currency): ReturnPackage
	{
		$this->currency = $currency;
		
		return $this;
	}
	
	/**
	 * @param VO\PackageSent $packageSent
	 * @return ReturnPackage
	 */
	public function setPackageSent(VO\PackageSent $packageSent): ReturnPackage
	{
		$this->packageSent = $packageSent;
		
		return $this;
	}
	
	/**
	 * @param VO\PackageNo $packageNo
	 * @return ReturnPackage
	 */
	public function setPackageNo(VO\PackageNo $packageNo): ReturnPackage
	{
		$this->packageNo = $packageNo;
		
		return $this;
	}
	
	/**
	 * @param VO\PackageSentAt $packageSentAt
	 * @return ReturnPackage
	 */
	public function setPackageSentAt(VO\PackageSentAt $packageSentAt): ReturnPackage
	{
		$this->packageSentAt = $packageSentAt;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->id->toString();
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setAggregateId($id): void
	{
		$this->setId(VO\Id::fromInteger((int)$id));
	}
	
	/**
	 * @param VO\Id $id
	 * @param VO\RgaUuid $rgaUuid
	 * @param VO\TransportUuid $transportUuid
	 * @param VO\NettPrice $nettPrice
	 * @param VO\VatRate $vatRate
	 * @param VO\Currency $currency
	 * @return ReturnPackage
	 */
	public static function createNewReturnPackage(
		VO\Id $id,
		VO\RgaUuid $rgaUuid,
		VO\TransportUuid $transportUuid,
		VO\NettPrice $nettPrice,
		VO\VatRate $vatRate,
		VO\Currency $currency
		
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
	 * @param VO\PackageNo $packageNo
	 * @param VO\PackageSentAt $packageSentAt
	 */
	public function setReturnPackage(
		VO\PackageNo $packageNo,
		VO\PackageSentAt $packageSentAt
	): void
	{
		$this->recordThat(Event\ReturnPackageSet::occur($this->aggregateId(), [
			'package_no' => $packageNo->toString(),
			'package_sent_at' => $packageSentAt->toString()
		]));
	}
}