<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class PackageNo
{
	/** @var string */
	private $no;
	
	/**
	 * @param string $no
	 * @return PackageNo
	 */
	public static function fromString(string $no): PackageNo
	{
		return new PackageNo($no);
	}
	
	/**
	 * @param string $no
	 */
	private function __construct(string $no)
	{
		Assertion::string($no, 'Invalid PackageNo string: ' . $no);
		
		$this->no = $no;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->no;
	}
	
	/**
	 * @param PackageNo $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof PackageNo)
		{
			return false;
		}
		
		return $this->no === $other->no;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->no;
	}
}