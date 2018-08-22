<?php

namespace RGA\Domain\ValueObject\Base;

class Reference
{
	/** @var string */
	private $stateUuid;
	
	/** @var string */
	private $behaviourUuid;
	
	/** @var string */
	private $transportUuid;
	
	/**
	 * @param string $stateUuid
	 * @param string $behaviourUuid
	 * @param string $transportUuid
	 */
	public function __construct($stateUuid, $behaviourUuid, $transportUuid)
	{
		$this->stateUuid = $stateUuid;
		$this->behaviourUuid = $behaviourUuid;
		$this->transportUuid = $transportUuid;
	}
	
	/**
	 * @return string
	 */
	public function getStateUuid(): string
	{
		return $this->stateUuid;
	}
	
	/**
	 * @return string
	 */
	public function getBehaviourUuid(): string
	{
		return $this->behaviourUuid;
	}
	
	/**
	 * @return string
	 */
	public function getTransportUuid(): string
	{
		return $this->transportUuid;
	}
}