<?php

namespace RGA\Domain\ValueObject\Base;

final class ObjectItem
{
	/** @var string */
	private $dateOfCreation;
	
	/** @var string */
	private $sourceType;
	
	/** @var integer */
	private $sourceID;
	
	/** @var integer */
	private $sourceItemID;
	
	/** @var string */
	private $givenSourceID;
	
	/** @var string */
	private $givenName;
	
	/** @var string */
	private $reason;
	
	/** @var string */
	private $expectation;
	
	/** @var string */
	private $incident;
	
	/** @var integer */
	private $variantID;
	
	/** @var string */
	private $productName;
	
	/** @var AttachmentCollection */
	private $attachments;
	
	/**
	 * @param string $dateOfCreation
	 * @param string $sourceType
	 * @param int $sourceID
	 * @param int $sourceItemID
	 * @param string $givenSourceID
	 * @param string $givenName
	 * @param string $reason
	 * @param string $expectation
	 * @param string $incident
	 * @param int $variantID
	 * @param string $productName
	 * @param AttachmentCollection $attachments
	 */
	public function __construct(
		string $dateOfCreation,
		string $sourceType,
		int $sourceID,
		int $sourceItemID,
		string $givenSourceID,
		string $givenName,
		string $reason,
		string $expectation,
		string $incident,
		int $variantID,
		string $productName,
		AttachmentCollection $attachments
	)
	{
		$this->dateOfCreation = $dateOfCreation;
		$this->sourceType = $sourceType;
		$this->sourceID = $sourceID;
		$this->sourceItemID = $sourceItemID;
		$this->givenSourceID = $givenSourceID;
		$this->givenName = $givenName;
		$this->reason = $reason;
		$this->expectation = $expectation;
		$this->incident = $incident;
		$this->variantID = $variantID;
		$this->productName = $productName;
		$this->attachments = $attachments;
	}
	
	/**
	 * @return string
	 */
	public function getDateOfCreation(): string
	{
		return $this->dateOfCreation;
	}
	
	/**
	 * @return string
	 */
	public function getSourceType(): string
	{
		return $this->sourceType;
	}
	
	/**
	 * @return int
	 */
	public function getSourceID(): int
	{
		return $this->sourceID;
	}
	
	/**
	 * @return int
	 */
	public function getSourceItemID(): int
	{
		return $this->sourceItemID;
	}
	
	/**
	 * @return string
	 */
	public function getGivenSourceID(): string
	{
		return $this->givenSourceID;
	}
	
	/**
	 * @return string
	 */
	public function getGivenName(): string
	{
		return $this->givenName;
	}
	
	/**
	 * @return string
	 */
	public function getReason(): string
	{
		return $this->reason;
	}
	
	/**
	 * @return string
	 */
	public function getExpectation(): string
	{
		return $this->expectation;
	}
	
	/**
	 * @return string
	 */
	public function getIncident(): string
	{
		return $this->incident;
	}
	
	/**
	 * @return int
	 */
	public function getVariantID(): int
	{
		return $this->variantID;
	}
	
	/**
	 * @return string
	 */
	public function getProductName(): string
	{
		return $this->productName;
	}
	
	/**
	 * @return AttachmentCollection
	 */
	public function getAttachments(): AttachmentCollection
	{
		return $this->attachments;
	}
}