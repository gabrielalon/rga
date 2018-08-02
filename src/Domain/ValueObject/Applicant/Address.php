<?php

namespace RGA\Domain\ValueObject\Applicant;

class Address
{
	/** @var string */
	private $fullName;
	
	/** @var string */
	private $streetName;
	
	/** @var string */
	private $buildingNumber;
	
	/** @var string */
	private $apartmentNumber;
	
	/** @var string */
	private $postalCode;
	
	/** @var string */
	private $city;
	
	/** @var string */
	private $countryCode;
	
	/**
	 * @param string $fullName
	 * @param string $streetName
	 * @param string $buildingNumber
	 * @param string $apartmentNumber
	 * @param string $postalCode
	 * @param string $city
	 * @param string $countryCode
	 */
	public function __construct($fullName, $streetName, $buildingNumber, $apartmentNumber, $postalCode, $city, $countryCode)
	{
		$this->fullName = $fullName;
		$this->streetName = $streetName;
		$this->buildingNumber = $buildingNumber;
		$this->apartmentNumber = $apartmentNumber;
		$this->postalCode = $postalCode;
		$this->city = $city;
		$this->countryCode = $countryCode;
	}
	
	/**
	 * @return string
	 */
	public function getFullName()
	{
		return $this->fullName;
	}
	
	/**
	 * @return string
	 */
	public function getStreetName()
	{
		return $this->streetName;
	}
	
	/**
	 * @return string
	 */
	public function getBuildingNumber()
	{
		return $this->buildingNumber;
	}
	
	/**
	 * @return string
	 */
	public function getApartmentNumber()
	{
		return $this->apartmentNumber;
	}
	
	/**
	 * @return string
	 */
	public function getPostalCode()
	{
		return $this->postalCode;
	}
	
	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}
	
	/**
	 * @return string
	 */
	public function getCountryCode()
	{
		return $this->countryCode;
	}
}