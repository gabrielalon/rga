<?php

namespace RGA\Domain\ValueObject\Base;

use RGA\Infrastructure\Log\Blamable\AdminInterface;

final class BlamableAdmin
	implements AdminInterface
{
	/** @var string */
	private $fullName;
	
	/** @var integer */
	private $referenceID;
	
	/**
	 * @param string $fullName
	 * @param int $referenceID
	 */
	public function __construct(string $fullName, int $referenceID = null)
	{
		$this->fullName = $fullName;
		$this->referenceID = $referenceID;
	}
	
	/**
	 * @return string
	 */
	public function getFullName(): string
	{
		return $this->fullName;
	}
	
	/**
	 * @return int
	 */
	public function getReferenceID(): int
	{
		return $this->referenceID;
	}
}