<?php

namespace RGA\Domain\Model\Source;

use RGA\Domain\ValueObject\Applicant;

class ObjectBuilder
{
	/** @var integer */
	private $objectId;
	
	/** @var string */
	private $objectType;
	
	/** @var bool */
	private $objectIsPaid;
	
	/** @var bool */
	private $objectHasCompletedState;
	
	/** @var string */
	private $firstName;
	
	/** @var string */
	private $lastName;
	
	/** @var string */
	private $email;
	
	/** @var string */
	private $telephone;
	
	/** @var string */
	private $streetName;
	
	/** @var string */
	private $houseNo;
	
	/** @var string */
	private $apartmentNo;
	
	/** @var string */
	private $postCode;
	
	/** @var string */
	private $city;
	
	/** @var string */
	private $countryCode;
	
	/** @var Applicant\Applicant */
	private $applicant;
	
	/** @var int */
	private $statusId = 0;
	
	/** @var  integer */
	private $objectCreatedAt;
	
	/** @var ObjectItemCollector */
	private $items;
	
	/**
	 * @param integer $objectId
	 * @param string $objectType
	 * @param Applicant\Applicant $applicant
	 * @param bool $objectIsPaid
	 * @param int $objectCreatedAt
	 * @param bool $objectHasCompletedState
	 */
	public function __construct($objectId, $objectType, Applicant\Applicant $applicant, $objectIsPaid, $objectCreatedAt, $objectHasCompletedState)
	{
		$this->objectId   = $objectId;
		$this->objectType = $objectType;
		$this->applicant      = $applicant;
		$this->objectIsPaid = $objectIsPaid;
		$this->objectCreatedAt = $objectCreatedAt;
		$this->objectHasCompletedState = $objectHasCompletedState;
		
	}
	
	/**
	 * @param string $firstName
	 * @return ObjectBuilder
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
		
		return $this;
	}
	
	/**
	 * @param string $lastName
	 * @return ObjectBuilder
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
		
		return $this;
	}
	
	/**
	 * @param string $email
	 * @return ObjectBuilder
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * @param string $telephone
	 * @return ObjectBuilder
	 */
	public function setTelephone($telephone)
	{
		$this->telephone = $telephone;
		
		return $this;
	}
	
	/**
	 * @param string $streetName
	 * @return ObjectBuilder
	 */
	public function setStreetName($streetName)
	{
		$this->streetName = $streetName;
		
		return $this;
	}
	
	/**
	 * @param string $houseNo
	 * @return ObjectBuilder
	 */
	public function setHouseNo($houseNo)
	{
		$this->houseNo = $houseNo;
		
		return $this;
	}
	
	/**
	 * @param string $apartmentNo
	 * @return ObjectBuilder
	 */
	public function setApartmentNo($apartmentNo)
	{
		$this->apartmentNo = $apartmentNo;
		
		return $this;
	}
	
	/**
	 * @param string $postCode
	 * @return ObjectBuilder
	 */
	public function setPostCode($postCode)
	{
		$this->postCode = $postCode;
		
		return $this;
	}
	
	/**
	 * @param string $city
	 * @return ObjectBuilder
	 */
	public function setCity($city)
	{
		$this->city = $city;
		
		return $this;
	}
	
	/**
	 * @param string $countryCode
	 * @return ObjectBuilder
	 */
	public function setCountryCode($countryCode)
	{
		$this->countryCode = $countryCode;
		
		return $this;
	}
	
	/**
	 * @param int $statusId
	 */
	public function setStatusId($statusId)
	{
		$this->statusId = $statusId;
	}
	
	/**
	 * @return Object
	 */
	public function build()
	{
		$address = $this->buildAddress();
		$contact = $this->buildContact();
		
		return new Object(
			$this->objectId,
			$this->objectType,
			$this->applicant,
			$address,
			$contact,
			$this->objectHasCompletedState,
			$this->objectIsPaid,
			$this->objectCreatedAt,
			$this->items
		);
	}
	
	/**
	 * @return Applicant\Address
	 */
	private function buildAddress()
	{
		return new Applicant\Address(
			$this->firstName . ' ' . $this->lastName,
			$this->streetName,
			$this->houseNo,
			$this->apartmentNo,
			$this->postCode,
			$this->city,
			$this->countryCode
		);
	}
	
	/**
	 * @return Applicant\Contact
	 */
	private function buildContact()
	{
		return new Applicant\Contact(
			$this->firstName,
			$this->lastName,
			$this->email,
			$this->telephone
		);
	}
	
	/**
	 * @param ObjectItemCollector $items
	 */
	public function setItems(ObjectItemCollector $items)
	{
		$this->items = $items;
	}
}