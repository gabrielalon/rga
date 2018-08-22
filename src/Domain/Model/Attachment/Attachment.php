<?php

namespace RGA\Domain\Model\Attachment;

use RGA\Domain\ValueObject;

class Attachment
{
	/** @var string */
	private $rgaUuid;
	
	/** @var string */
	private $fileType;
	
	/** @var string */
	private $fileName;
	
	/** @var string */
	private $originalFileName;
	
	/**
	 * @return string
	 */
	public function getRgaUuid(): string
	{
		return $this->rgaUuid;
	}
	
	/**
	 * @param ValueObject\Attachment\RgaUuid $rgaUuid
	 */
	public function setRgaUuid(ValueObject\Attachment\RgaUuid $rgaUuid): void
	{
		$this->rgaUuid = $rgaUuid->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getFileType(): string
	{
		return $this->fileType;
	}
	
	/**
	 * @param ValueObject\Attachment\FileType $fileType
	 */
	public function setFileType(ValueObject\Attachment\FileType $fileType): void
	{
		$this->fileType = $fileType->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getFileName(): string
	{
		return $this->fileName;
	}
	
	/**
	 * @param ValueObject\Attachment\FileName $fileName
	 */
	public function setFileName(ValueObject\Attachment\FileName $fileName): void
	{
		$this->fileName = $fileName->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getOriginalFileName(): string
	{
		return $this->originalFileName;
	}
	
	/**
	 * @param ValueObject\Attachment\OriginalFileName $originalFileName
	 */
	public function setOriginalFileName(ValueObject\Attachment\OriginalFileName $originalFileName): void
	{
		$this->originalFileName = $originalFileName->getValue();
	}
}