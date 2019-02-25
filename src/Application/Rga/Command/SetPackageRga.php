<?php

namespace RGA\Application\Rga\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class SetPackageRga
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var string */
	private $packageNo;
	
	/** @var string */
	private $sentAt;
	
	/**
	 * @param string $uuid
	 * @param string $packageNo
	 * @param string $sentAt
	 */
	public function __construct(string $uuid, string $packageNo, string $sentAt)
	{
		$this->setIdentifier($uuid);
		$this->packageNo = $packageNo;
		$this->sentAt = $sentAt;
	}
	
	/**
	 * @return string
	 */
	public function getPackageNo(): string
	{
		return $this->packageNo;
	}
	
	/**
	 * @return string
	 */
	public function getSentAt(): string
	{
		return $this->sentAt;
	}
}