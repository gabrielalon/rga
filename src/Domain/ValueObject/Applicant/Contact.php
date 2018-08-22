<?php

namespace RGA\Domain\ValueObject\Applicant;

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
	public function __construct($email, $telephone, $preferredForm)
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