<?php

namespace RGA\Test\Mock\Entity\ReturnPackage;

use RGA\Domain\Model\ReturnPackage\ReturnPackage as ValueObject;

class ReturnPackage
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
	 * @return ValueObject\Id
	 */
	public function getId(): ValueObject\Id
	{
		return $this->id;
	}
	
	/**
	 * @param ValueObject\Id $id
	 * @return ReturnPackage
	 */
	public function setId(ValueObject\Id $id): ReturnPackage
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\RgaUuid
	 */
	public function getRgaUuid(): ValueObject\RgaUuid
	{
		return $this->rgaUuid;
	}
	
	/**
	 * @param ValueObject\RgaUuid $rgaUuid
	 * @return ReturnPackage
	 */
	public function setRgaUuid(ValueObject\RgaUuid $rgaUuid): ReturnPackage
	{
		$this->rgaUuid = $rgaUuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\TransportUuid
	 */
	public function getTransportUuid(): ValueObject\TransportUuid
	{
		return $this->transportUuid;
	}
	
	/**
	 * @param ValueObject\TransportUuid $transportUuid
	 * @return ReturnPackage
	 */
	public function setTransportUuid(ValueObject\TransportUuid $transportUuid): ReturnPackage
	{
		$this->transportUuid = $transportUuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\NettPrice
	 */
	public function getNettPrice(): ValueObject\NettPrice
	{
		return $this->nettPrice;
	}
	
	/**
	 * @param ValueObject\NettPrice $nettPrice
	 * @return ReturnPackage
	 */
	public function setNettPrice(ValueObject\NettPrice $nettPrice): ReturnPackage
	{
		$this->nettPrice = $nettPrice;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\VatRate
	 */
	public function getVatRate(): ValueObject\VatRate
	{
		return $this->vatRate;
	}
	
	/**
	 * @param ValueObject\VatRate $vatRate
	 * @return ReturnPackage
	 */
	public function setVatRate(ValueObject\VatRate $vatRate): ReturnPackage
	{
		$this->vatRate = $vatRate;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Currency
	 */
	public function getCurrency(): ValueObject\Currency
	{
		return $this->currency;
	}
	
	/**
	 * @param ValueObject\Currency $currency
	 * @return ReturnPackage
	 */
	public function setCurrency(ValueObject\Currency $currency): ReturnPackage
	{
		$this->currency = $currency;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\PackageSent
	 */
	public function getPackageSent(): ValueObject\PackageSent
	{
		return $this->packageSent;
	}
	
	/**
	 * @param ValueObject\PackageSent $packageSent
	 * @return ReturnPackage
	 */
	public function setPackageSent(ValueObject\PackageSent $packageSent): ReturnPackage
	{
		$this->packageSent = $packageSent;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\PackageNo
	 */
	public function getPackageNo(): ValueObject\PackageNo
	{
		return $this->packageNo;
	}
	
	/**
	 * @param ValueObject\PackageNo $packageNo
	 * @return ReturnPackage
	 */
	public function setPackageNo(ValueObject\PackageNo $packageNo): ReturnPackage
	{
		$this->packageNo = $packageNo;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\PackageSentAt
	 */
	public function getPackageSentAt(): ValueObject\PackageSentAt
	{
		return $this->packageSentAt;
	}
	
	/**
	 * @param ValueObject\PackageSentAt $packageSentAt
	 * @return ReturnPackage
	 */
	public function setPackageSentAt(ValueObject\PackageSentAt $packageSentAt): ReturnPackage
	{
		$this->packageSentAt = $packageSentAt;
		
		return $this;
	}
}