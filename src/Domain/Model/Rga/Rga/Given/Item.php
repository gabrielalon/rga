<?php

namespace RGA\Domain\Model\Rga\Rga\Given;

use RGA\Infrastructure\Source\RgaObject\RgaObjectItemInterface;

class Item
	implements RgaObjectItemInterface
{
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
	
	/** @var Attachment[] */
	private $attachments = [];
	
	/**
	 * @param int $sourceItemID
	 * @param string $givenSourceID
	 * @param string $givenName
	 * @param string $reason
	 * @param string $expectation
	 * @param string $incident
	 * @param Attachment[] $attachments
	 */
	public function __construct(
		int $sourceItemID,
		string $givenSourceID,
		string $givenName,
		string $reason,
		string $expectation,
		string $incident,
		array $attachments = []
	)
	{
		$this->sourceItemID = $sourceItemID;
		$this->givenSourceID = $givenSourceID;
		$this->givenName = $givenName;
		$this->reason = $reason;
		$this->expectation = $expectation;
		$this->incident = $incident;
		$this->attachments = $attachments;
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
	 * @return Attachment[]
	 */
	public function getAttachments(): array
	{
		return $this->attachments;
	}
	
	/**
	 * @return integer
	 */
	public function getId(): int
	{
		return 0;
	}
	
	/**
	 * @return integer
	 */
	public function getVariantId(): int
	{
		return 0;
	}
	
	/**
	 * @return boolean
	 */
	public function isRgaAble(): bool
	{
		return true;
	}
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->getGivenName();
	}
	
	/**
	 * @return integer|null
	 */
	public function getFinalDateOfComplaint(): ?int
	{
		return null;
	}
	
	/**
	 * @return integer|null
	 */
	public function getFinalDateOfReturn(): ?int
	{
		return null;
	}
	
	/**
	 * @return integer|null
	 */
	public function getWarranty(): ?int
	{
		return null;
	}
}