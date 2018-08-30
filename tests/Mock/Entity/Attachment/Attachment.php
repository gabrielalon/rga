<?php

namespace RGA\Test\Mock\Entity\Attachment;

use RGA\Domain\Model\Attachment\Attachment as ValueObject;

class Attachment
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\RgaUuid */
	private $rgaUuid;
	
	/** @var ValueObject\FileType */
	private $fileType;
	
	/** @var ValueObject\FileName */
	private $fileName;
	
	/** @var ValueObject\OriginalFileName */
	private $originalFileName;
	
	/**
	 * @return ValueObject\Uuid
	 */
	public function getUuid(): ValueObject\Uuid
	{
		return $this->uuid;
	}
	
	/**
	 * @param ValueObject\Uuid $uuid
	 * @return Attachment
	 */
	public function setUuid(ValueObject\Uuid $uuid): Attachment
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\RgaUuid
	 */
	public function getRgaUuid(): ValueObject\RgaUuid
	{
		return $this->rgaUuid;
	}
	
	/**
	 * @param ValueObject\RgaUuid $rgaUuid
	 * @return Attachment
	 */
	public function setRgaUuid(ValueObject\RgaUuid $rgaUuid): Attachment
	{
		$this->rgaUuid = $rgaUuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\FileType
	 */
	public function getFileType(): ValueObject\FileType
	{
		return $this->fileType;
	}
	
	/**
	 * @param ValueObject\FileType $fileType
	 * @return Attachment
	 */
	public function setFileType(ValueObject\FileType $fileType): Attachment
	{
		$this->fileType = $fileType;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\FileName
	 */
	public function getFileName(): ValueObject\FileName
	{
		return $this->fileName;
	}
	
	/**
	 * @param ValueObject\FileName $fileName
	 * @return Attachment
	 */
	public function setFileName(ValueObject\FileName $fileName): Attachment
	{
		$this->fileName = $fileName;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\OriginalFileName
	 */
	public function getOriginalFileName(): ValueObject\OriginalFileName
	{
		return $this->originalFileName;
	}
	
	/**
	 * @param ValueObject\OriginalFileName $originalFileName
	 * @return Attachment
	 */
	public function setOriginalFileName(ValueObject\OriginalFileName $originalFileName): Attachment
	{
		$this->originalFileName = $originalFileName;
		
		return $this;
	}
}