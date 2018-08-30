<?php

namespace RGA\Test\Mock\Entity\Transport;

use RGA\Domain\Model\Transport\Transport as ValueObject;

class Transport
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Activation */
	private $activation;
	
	/** @var ValueObject\ShipmentId */
	private $shipmentId;
	
	/** @var ValueObject\Domains */
	private $domains;
	
	/** @var ValueObject\Names */
	private $names;
	
	/**
	 * @return ValueObject\Uuid
	 */
	public function getUuid(): ValueObject\Uuid
	{
		return $this->uuid;
	}
	
	/**
	 * @param ValueObject\Uuid $uuid
	 * @return Transport
	 */
	public function setUuid(ValueObject\Uuid $uuid): Transport
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Activation
	 */
	public function getActivation(): ValueObject\Activation
	{
		return $this->activation;
	}
	
	/**
	 * @param ValueObject\Activation $activation
	 * @return Transport
	 */
	public function setActivation(ValueObject\Activation $activation): Transport
	{
		$this->activation = $activation;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ShipmentId
	 */
	public function getShipmentId(): ValueObject\ShipmentId
	{
		return $this->shipmentId;
	}
	
	/**
	 * @param ValueObject\ShipmentId $shipmentId
	 * @return Transport
	 */
	public function setShipmentId(ValueObject\ShipmentId $shipmentId): Transport
	{
		$this->shipmentId = $shipmentId;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Domains
	 */
	public function getDomains(): ValueObject\Domains
	{
		return $this->domains;
	}
	
	/**
	 * @param ValueObject\Domains $domains
	 * @return Transport
	 */
	public function setDomains(ValueObject\Domains $domains): Transport
	{
		$this->domains = $domains;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Names
	 */
	public function getNames(): ValueObject\Names
	{
		return $this->names;
	}
	
	/**
	 * @param ValueObject\Names $names
	 * @return Transport
	 */
	public function setNames(ValueObject\Names $names): Transport
	{
		$this->names = $names;
		
		return $this;
	}
}