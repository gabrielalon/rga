<?php

namespace RGA\Application\Command\Command\Transport;

use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateTransport
	implements CommandInterface
{
	/** @var string */
	private $uuid;

	/** @var boolean */
	private $isActive;

	/** @var array */
	private $names;

	/** @var array */
	private $aliases;

	/** @var string */
	private $courierSymbol;
	
	/**
	 * @param string $uuid
	 * @param bool $isActive
	 * @param array $names
	 * @param array $aliases
	 * @param string $courierSymbol
	 */
	public function __construct(
		string $uuid,
		bool $isActive,
		array $names,
		array $aliases,
		string $courierSymbol
	)
	{
		$this->uuid = $uuid;
		$this->isActive = $isActive;
		$this->names = $names;
		$this->aliases = $aliases;
		$this->courierSymbol = $courierSymbol;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @return array
	 */
	public function getNames(): array
	{
		return $this->names;
	}
	
	/**
	 * @return array
	 */
	public function getAliases(): array
	{
		return $this->aliases;
	}
	
	/**
	 * @return string
	 */
	public function getCourierSymbol(): string
	{
		return $this->courierSymbol;
	}
}