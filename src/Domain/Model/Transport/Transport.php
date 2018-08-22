<?php

namespace RGA\Domain\Model\Transport;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Identify;
use RGA\Infrastructure\Model\Translate;

class Transport
	implements Identify\Guidable, Translate\Localable
{
	use Identify\Guided;
	use Translate\Localed;
	
	/** @var boolean */
	protected $isActive;
	
	/** @var string */
	protected $courierSymbol;
	
	/** @var TransportAliasCollector */
	protected $aliases;
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @param ValueObject\Transport\IsActive $isActive
	 */
	public function setIsActive(ValueObject\Transport\IsActive $isActive)
	{
		$this->isActive = $isActive->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getCourierSymbol(): string
	{
		return $this->courierSymbol;
	}
	
	/**
	 * @param ValueObject\Transport\CourierSymbol $courierSymbol
	 */
	public function setCourierSymbol(ValueObject\Transport\CourierSymbol $courierSymbol)
	{
		$this->courierSymbol = $courierSymbol->getValue();
	}
	
	/**
	 * @return TransportAliasCollector
	 */
	public function getAliases(): TransportAliasCollector
	{
		return $this->aliases;
	}
	
	/**
	 * @param TransportAliasCollector $aliases
	 */
	public function setAliases(TransportAliasCollector $aliases)
	{
		$this->aliases = $aliases;
	}
}