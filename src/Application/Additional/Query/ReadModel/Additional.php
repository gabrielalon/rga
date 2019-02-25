<?php

namespace RGA\Application\Additional\Query\ReadModel;

use RGA\Domain\Model\Additional\Additional as VO;
use RGA\Infrastructure\SegregationSourcing;

class Additional
	implements SegregationSourcing\Query\Query\Viewable
{
	/** @var integer */
	protected $identifier;
	
	/** @var VO\RgaUuid */
	protected $rgaUuid;
	
	/** @var VO\ServiceType */
	protected $serviceType;
	
	/** @var VO\ServiceData */
	protected $serviceData;
	
	/**
	 * @param int $identifier
	 */
	public function __construct($identifier)
	{
		$this->setIdentifier($identifier);
	}
	
	/**
	 * @param string|integer $id
	 * @return Additional
	 */
	public static function fromId($id): self
	{
		return new static($id);
	}
	
	/**
	 * @return string|integer
	 */
	public function identifier()
	{
		return $this->identifier;
	}
	
	/**
	 * @param int $identifier
	 */
	public function setIdentifier($identifier): void
	{
		$this->identifier = $identifier;
	}
	
	/**
	 * @return int
	 */
	public function getIdentifier(): int
	{
		return $this->identifier;
	}
	
	/**
	 * @return string
	 */
	public function rgaUuid(): string
	{
		return $this->rgaUuid->toString();
	}
	
	/**
	 * @param VO\RgaUuid $rgaUuid
	 * @return Additional
	 */
	public function setRgaUuid(VO\RgaUuid $rgaUuid): Additional
	{
		$this->rgaUuid = $rgaUuid;
		
		return $this;
	}
	
	/**
	 * @return VO\RgaUuid
	 */
	public function getRgaUuid(): VO\RgaUuid
	{
		return $this->rgaUuid;
	}
	
	/**
	 * @return string
	 */
	public function serviceType(): string 
	{
		return $this->serviceType->toString();
	}
	
	/**
	 * @return VO\ServiceType
	 */
	public function getServiceType(): VO\ServiceType
	{
		return $this->serviceType;
	}
	
	/**
	 * @param VO\ServiceType $serviceType
	 * @return Additional
	 */
	public function setServiceType(VO\ServiceType $serviceType): Additional
	{
		$this->serviceType = $serviceType;
		
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function serviceData(): array
	{
		return $this->serviceData->raw();
	}
	
	/**
	 * @return VO\ServiceData
	 */
	public function getServiceData(): VO\ServiceData
	{
		return $this->serviceData;
	}
	
	/**
	 * @param VO\ServiceData $serviceData
	 * @return Additional
	 */
	public function setServiceData(VO\ServiceData $serviceData): Additional
	{
		$this->serviceData = $serviceData;
		
		return $this;
	}
}