<?php

namespace RGA\Domain\Model\Attachment\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateAttachment
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var string */
	private $rgaUuid;
	
	/** @var string */
	private $fileType;
	
	/** @var string */
	private $fileName;
	
	/** @var string */
	private $originalFileName;
	
	/**
	 * @param string $uuid
	 * @param string $rgaUuid
	 * @param string $fileType
	 * @param string $fileName
	 * @param string $originalFileName
	 */
	public function __construct(
		string $uuid,
		string $rgaUuid,
		string $fileType,
		string $fileName,
		string $originalFileName
	)
	{
		$this->setUuid($uuid);
		$this->rgaUuid = $rgaUuid;
		$this->fileType = $fileType;
		$this->fileName = $fileName;
		$this->originalFileName = $originalFileName;
	}
	
	/**
	 * @return string
	 */
	public function getRgaUuid(): string
	{
		return $this->rgaUuid;
	}
	
	/**
	 * @return string
	 */
	public function getFileType(): string
	{
		return $this->fileType;
	}
	
	/**
	 * @return string
	 */
	public function getFileName(): string
	{
		return $this->fileName;
	}
	
	/**
	 * @return string
	 */
	public function getOriginalFileName(): string
	{
		return $this->originalFileName;
	}
}