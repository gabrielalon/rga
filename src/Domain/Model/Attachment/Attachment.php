<?php

namespace RGA\Domain\Model\Attachment;

use RGA\Domain\Model\Attachment\Attachment as ValueObject;
use RGA\Domain\Model\Attachment\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Attachment
	extends Aggregate\AggregateRoot
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
	 * @param Attachment\Uuid $uuid
	 */
	public function setUuid(Attachment\Uuid $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @param Attachment\RgaUuid $rgaUuid
	 */
	public function setRgaUuid(Attachment\RgaUuid $rgaUuid): void
	{
		$this->rgaUuid = $rgaUuid;
	}
	
	/**
	 * @param Attachment\FileType $fileType
	 */
	public function setFileType(Attachment\FileType $fileType): void
	{
		$this->fileType = $fileType;
	}
	
	/**
	 * @param Attachment\FileName $fileName
	 */
	public function setFileName(Attachment\FileName $fileName): void
	{
		$this->fileName = $fileName;
	}
	
	/**
	 * @param Attachment\OriginalFileName $originalFileName
	 */
	public function setOriginalFileName(Attachment\OriginalFileName $originalFileName): void
	{
		$this->originalFileName = $originalFileName;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * @param Attachment\Uuid $uuid
	 * @param Attachment\RgaUuid $rgaUuid
	 * @param Attachment\FileType $fileType
	 * @param Attachment\FileName $fileName
	 * @param Attachment\OriginalFileName $originalFileName
	 * @return Attachment
	 */
	public static function createNewAttachment(
		ValueObject\Uuid $uuid,
		ValueObject\RgaUuid $rgaUuid,
		ValueObject\FileType $fileType,
		ValueObject\FileName $fileName,
		ValueObject\OriginalFileName $originalFileName
	): Attachment
	{
		$attachment = new Attachment();
		
		$attachment->recordThat(Event\NewAttachmentCreated::occur($uuid->toString(), [
			'rga_uuid'           => $rgaUuid->toString(),
			'file_type'          => $fileType->toString(),
			'file_name'          => $fileName->toString(),
			'original_file_name' => $originalFileName->toString()
		]));
		
		return $attachment;
	}
	
	public function removeExistingAttachment(): void
	{
		$this->recordThat(Event\ExistingAttachmentRemoved::occur($this->aggregateId(), []));
	}
}