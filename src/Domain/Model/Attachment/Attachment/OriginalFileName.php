<?php

namespace RGA\Domain\Model\Attachment\Attachment;

use RGA\Application\Assert\Assertion;

final class OriginalFileName
{
	/** @var string */
	private $fileName;
	
	/**
	 * @param string $fileName
	 * @return OriginalFileName
	 */
	public static function fromString(string $fileName): OriginalFileName
	{
		return new OriginalFileName($fileName);
	}
	
	/**
	 * @param string $fileName
	 */
	private function __construct(string $fileName)
	{
		Assertion::string($fileName, 'Invalid OriginalFileName string: ' . $fileName);
		
		$this->fileName = $fileName;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param OriginalFileName $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof OriginalFileName)
		{
			return false;
		}
		
		return $this->fileName === $other->fileName;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->fileName;
	}
}