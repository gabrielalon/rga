<?php

namespace RGA\Domain\Model\Attachment\Attachment;

use RGA\Application\Assert\Assertion;

final class FileType
{
	/** @var string */
	private $fileType;
	
	/**
	 * @param string $fileType
	 * @return FileType
	 */
	public static function fromString(string $fileType): FileType
	{
		return new FileType($fileType);
	}
	
	/**
	 * @param string $fileType
	 */
	private function __construct(string $fileType)
	{
		Assertion::string($fileType, 'Invalid FileType string: ' . $fileType);
		
		$this->fileType = $fileType;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param FileType $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof FileType)
		{
			return false;
		}
		
		return $this->fileType === $other->fileType;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->fileType;
	}
}