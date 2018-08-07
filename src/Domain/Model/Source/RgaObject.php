<?php

namespace RGA\Domain\Model\Source;

use RGA\Domain\ValueObject\Applicant;
use RGA\Infrastructure\Source\RgaObject\RgaObjectInterface;

class RgaObject
	implements RgaObjectInterface
{
	/** @var integer */
	private $id;
	
	/** @var string */
	private $type;
	
	/** @var Applicant\Applicant */
	private $applicant;
	
	/** @var Applicant\Address */
	private $address;
	
	/** @var Applicant\Contact */
	private $contact;
	
	/** @var boolean */
	private $hasCompletedState;
	
	/** @var  boolean */
	private $isPaid;
	
	/** @var  integer */
	private $createdAt;
	
	/** @var RgaObjectItemCollector */
	private $items;
	
	/**
	 * @param string $id
	 * @param string $type
	 * @param Applicant\Applicant $applicant
	 * @param Applicant\Address $address
	 * @param Applicant\Contact $contact
	 * @param bool $hasCompletedState
	 * @param bool $isPaid
	 * @param int $createdAt
	 * @param RgaObjectItemCollector $items
	 */
	public function __construct(
		$id = null,
		$type = null,
		Applicant\Applicant $applicant = null,
		Applicant\Address $address = null,
		Applicant\Contact $contact = null,
		$hasCompletedState = null,
		$isPaid = null,
		$createdAt = null,
		RgaObjectItemCollector $items
	) {
		$this->id = $id;
		$this->type = $type;
		$this->applicant = $applicant;
		$this->address = $address;
		$this->contact = $contact;
		$this->hasCompletedState = $hasCompletedState;
		$this->isPaid = $isPaid;
		$this->createdAt = $createdAt;
		$this->items = $items;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return Applicant\Applicant
	 */
	public function getApplicant()
	{
		// TODO: Implement getBuyer() method.
	}
	
	/**
	 * @return Applicant\Address
	 */
	public function getAddress()
	{
		// TODO: Implement getAddress() method.
	}
	
	/**
	 * @return Applicant\Contact
	 */
	public function getContact()
	{
		// TODO: Implement getContact() method.
	}
	
	/**
	 * @return int
	 */
	public function getCreatedAt()
	{
		// TODO: Implement getCreatedAt() method.
	}
}