<?php

namespace RGA\Domain\Model\Log;

use RGA\Domain\ValueObject;

class Change
{
	/** @var string */
	private $rgaUuid;
	
	/** @var string */
	private $type;
	
	/** @var \DateTime */
	private $recordedOn;
	
	/** @var array */
	private $metadata;
	
	/** @var string */
	private $adminName;
	
	/** @var integer */
	private $adminID;
	
	/**
	 * @return string
	 */
	public function getRgaUuid(): string
	{
		return $this->rgaUuid;
	}
	
	/**
	 * @param ValueObject\Log\RgaUuid $rgaUuid
	 */
	public function setRgaUuid(ValueObject\Log\RgaUuid $rgaUuid): void
	{
		$this->rgaUuid = $rgaUuid->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
	
	/**
	 * @param ValueObject\Log\Type $type
	 */
	public function setType(ValueObject\Log\Type $type): void
	{
		$this->type = $type->getValue();
	}
	
	/**
	 * @return \DateTime
	 */
	public function getRecordedOn(): \DateTime
	{
		return $this->recordedOn;
	}
	
	/**
	 * @param ValueObject\Log\RecordedOn $recordedOn
	 */
	public function setRecordedOn(ValueObject\Log\RecordedOn $recordedOn): void
	{
		$this->recordedOn = $recordedOn->getValue();
	}
	
	/**
	 * @return array
	 */
	public function getMetadata(): array
	{
		return $this->metadata;
	}
	
	/**
	 * @param ValueObject\Log\Metadata $metadata
	 */
	public function setMetadata(ValueObject\Log\Metadata $metadata): void
	{
		$this->metadata = $metadata->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getAdminName(): string
	{
		return $this->adminName;
	}
	
	/**
	 * @param ValueObject\Log\AdminName $adminName
	 */
	public function setAdminName(ValueObject\Log\AdminName $adminName): void
	{
		$this->adminName = $adminName->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getAdminID(): int
	{
		return $this->adminID;
	}
	
	/**
	 * @param ValueObject\Log\AdminID $adminID
	 */
	public function setAdminID(ValueObject\Log\AdminID $adminID): void
	{
		$this->adminID = $adminID->getValue();
	}
}