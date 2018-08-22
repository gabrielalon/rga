<?php

namespace RGA\Application\Command\Command\Base;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Command\Command\CommandInterface;

class UpdateRgaApplicant
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var ValueObject\Applicant\Address */
	private $address;
	
	/** @var ValueObject\Applicant\Contact */
	private $contact;
	
	/** @var ValueObject\Applicant\Bank */
	private $bank;
	
	/** @var ValueObject\Base\BlamableAdmin */
	private $admin;
	
	/**
	 * @param string $uuid
	 * @param ValueObject\Applicant\Address $address
	 * @param ValueObject\Applicant\Contact $contact
	 * @param ValueObject\Applicant\Bank $bank
	 * @param ValueObject\Base\BlamableAdmin $admin
	 */
	public function __construct(
		string $uuid,
		ValueObject\Applicant\Address $address,
		ValueObject\Applicant\Contact $contact,
		ValueObject\Applicant\Bank $bank,
		ValueObject\Base\BlamableAdmin $admin
	)
	{
		$this->uuid = $uuid;
		$this->address = $address;
		$this->contact = $contact;
		$this->bank = $bank;
		$this->admin = $admin;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @return ValueObject\Applicant\Address
	 */
	public function getAddress(): ValueObject\Applicant\Address
	{
		return $this->address;
	}
	
	/**
	 * @return ValueObject\Applicant\Contact
	 */
	public function getContact(): ValueObject\Applicant\Contact
	{
		return $this->contact;
	}
	
	/**
	 * @return ValueObject\Applicant\Bank
	 */
	public function getBank(): ValueObject\Applicant\Bank
	{
		return $this->bank;
	}
	
	/**
	 * @return ValueObject\Base\BlamableAdmin
	 */
	public function getAdmin(): ValueObject\Base\BlamableAdmin
	{
		return $this->admin;
	}
}