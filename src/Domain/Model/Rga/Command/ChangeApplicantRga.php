<?php

namespace RGA\Domain\Model\Rga\Command;

use RGA\Domain\Model\Rga\Rga\Applicant;
use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeApplicantRga
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var Applicant\Address */
	private $address;
	
	/** @var Applicant\Contact */
	private $contact;
	
	/** @var Applicant\Bank */
	private $bank;
	
	/**
	 * @param string $uuid
	 * @param Applicant\Address $address
	 * @param Applicant\Contact $contact
	 * @param Applicant\Bank $bank
	 */
	public function __construct(
		string $uuid,
		Applicant\Address $address,
		Applicant\Contact $contact,
		Applicant\Bank $bank
	)
	{
		$this->setUuid($uuid);
		$this->address = $address;
		$this->contact = $contact;
		$this->bank = $bank;
	}
	
	/**
	 * @return Applicant\Address
	 */
	public function getAddress(): Applicant\Address
	{
		return $this->address;
	}
	
	/**
	 * @return Applicant\Contact
	 */
	public function getContact(): Applicant\Contact
	{
		return $this->contact;
	}
	
	/**
	 * @return Applicant\Bank
	 */
	public function getBank(): Applicant\Bank
	{
		return $this->bank;
	}
}