<?php

namespace RGA\Application\Command\Command\Base;

use RGA\Domain\Model\Source;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Command\Command\CommandInterface;

class MakeRga
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var ValueObject\Applicant\Applicant */
	private $applicant;
	
	/** @var ValueObject\Applicant\Address */
	private $address;
	
	/** @var ValueObject\Applicant\Contact */
	private $contact;
	
	/** @var ValueObject\Applicant\Bank */
	private $bank;
	
	/** @var ValueObject\Base\ObjectItemCollection */
	private $objectCollection;
	
	/** @var ValueObject\Base\Reference */
	private $reference;
	
	/** @var Source\RgaObject */
	private $object;
	
	/** @var ValueObject\Base\BlamableAdmin */
	private $admin;
	
	/**
	 * @param string $uuid
	 * @param ValueObject\Applicant\Applicant $applicant
	 * @param ValueObject\Applicant\Address $address
	 * @param ValueObject\Applicant\Contact $contact
	 * @param ValueObject\Applicant\Bank $bank
	 * @param ValueObject\Base\ObjectItemCollection $objectCollection
	 * @param ValueObject\Base\Reference $reference
	 * @param Source\RgaObject $object
	 * @param ValueObject\Base\BlamableAdmin $admin
	 */
	public function __construct(
		string $uuid,
		ValueObject\Applicant\Applicant $applicant,
		ValueObject\Applicant\Address $address,
		ValueObject\Applicant\Contact $contact,
		ValueObject\Applicant\Bank $bank,
		ValueObject\Base\ObjectItemCollection $objectCollection,
		ValueObject\Base\Reference $reference,
		Source\RgaObject $object,
		ValueObject\Base\BlamableAdmin $admin
	)
	{
		$this->uuid = $uuid;
		$this->applicant = $applicant;
		$this->address = $address;
		$this->contact = $contact;
		$this->bank = $bank;
		$this->objectCollection = $objectCollection;
		$this->reference = $reference;
		$this->object = $object;
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
	 * @return ValueObject\Applicant\Applicant
	 */
	public function getApplicant(): ValueObject\Applicant\Applicant
	{
		return $this->applicant;
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
	 * @return ValueObject\Base\ObjectItemCollection
	 */
	public function getObjectCollection(): ValueObject\Base\ObjectItemCollection
	{
		return $this->objectCollection;
	}
	
	/**
	 * @return ValueObject\Base\Reference
	 */
	public function getReference(): ValueObject\Base\Reference
	{
		return $this->reference;
	}
	
	/**
	 * @return Source\RgaObject
	 */
	public function getObject(): Source\RgaObject
	{
		return $this->object;
	}
	
	/**
	 * @return ValueObject\Base\BlamableAdmin
	 */
	public function getAdmin(): ValueObject\Base\BlamableAdmin
	{
		return $this->admin;
	}
}