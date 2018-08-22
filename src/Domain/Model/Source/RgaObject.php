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
	
	/** @var boolean */
	private $isPaid;
	
	/** @var integer */
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
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
	
	/**
	 * @return Applicant\Applicant
	 */
	public function getApplicant(): Applicant\Applicant
	{
		return $this->applicant;
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
	 * @return bool
	 */
	public function hasCompletedState(): bool
	{
		return $this->hasCompletedState;
	}
	
	/**
	 * @return bool
	 */
	public function isPaid(): bool
	{
		return $this->isPaid;
	}
	
	/**
	 * @return int
	 */
	public function getCreatedAt(): int
	{
		return $this->createdAt;
	}
	
	/**
	 * @return RgaObjectItemCollector
	 */
	public function getItems(): RgaObjectItemCollector
	{
		return $this->items;
	}
}