<?php

namespace RGA\Domain\ValueObject\Applicant;

class Contact
{
	/** @var string */
	private $firstName;
	
	/** @var string */
	private $lastName;
	
	/** @var string */
	private $email;
	
	/** @var string */
	private $telephone;
	
	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $email
	 * @param string $telephone
	 */
	public function __construct($firstName, $lastName, $email, $telephone)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->telephone = $telephone;
	}
	
	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}
	
	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * @return string
	 */
	public function getTelephone()
	{
		return $this->telephone;
	}
}