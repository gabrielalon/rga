<?php

namespace RGA\Domain\Model\Transport;

use RGA\Infrastructure\Model;

class Transport
	implements Model\Identify\GuidInterface, Model\Translate\Lang\CollectionInterface
{
	use Model\Identify\Guided;
	use Model\Translate\Lang\Collected;
	
	/** @var boolean */
	protected $isActive;
	
	/** @var string */
	protected $courierSymbol;
	
	/** @var TransportAliasCollector */
	protected $aliases;
	
	/**
	 * @return bool
	 */
	public function isActive()
	{
		return $this->isActive;
	}
	
	/**
	 * @param bool $isActive
	 */
	public function setIsActive(bool $isActive)
	{
		$this->isActive = $isActive;
	}
	
	/**
	 * @return string
	 */
	public function getCourierSymbol()
	{
		return $this->courierSymbol;
	}
	
	/**
	 * @param string $courierSymbol
	 */
	public function setCourierSymbol(string $courierSymbol)
	{
		$this->courierSymbol = $courierSymbol;
	}
	
	/**
	 * @return TransportAliasCollector
	 */
	public function getAliases()
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