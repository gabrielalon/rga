<?php

namespace RGA\Domain\Model\Rga\Rga\Applicant;

use RGA\Domain\Model\Source\Enum\PreferredFormOfContact;

class Contact
{
	/** @var string */
	private $email;
	
	/** @var string */
	private $telephone;
	
	/** @var string */
	private $preferredForm;
	
	/**
	 * @param string $email
	 * @param string $telephone
	 * @param string $preferredForm
	 */
	public function __construct($email, $telephone, $preferredForm = PreferredFormOfContact::__default)
	{
		$this->email = $email;
		$this->telephone = $telephone;
		$this->preferredForm = $preferredForm;
	}
	
	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}
	
	/**
	 * @return string
	 */
	public function getTelephone(): string
	{
		return $this->telephone;
	}
	
	/**
	 * @return string
	 */
	public function getPreferredForm(): string
	{
		return $this->preferredForm;
	}
}