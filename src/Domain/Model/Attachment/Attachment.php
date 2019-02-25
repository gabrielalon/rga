<?php

namespace RGA\Domain\Model\Attachment;

use RGA\Domain\Model\Attachment\Attachment as VO;
use RGA\Application\Attachment\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Attachment
	extends Aggregate\AggregateRoot
{
	/** @var VO\Uuid */
	protected $uuid;
	
	/** @var VO\RgaUuid */
	protected $rgaUuid;
	
	/** @var VO\FileType */
	protected $fileType;
	
	/** @var VO\FileName */
	protected $fileName;
	
	/** @var VO\OriginalFileName */
	protected $originalFileName;
	
	/**
	 * @param Attachment\Uuid $uuid
	 * @return Attachment
	 */
	public function setUuid(Attachment\Uuid $uuid): Attachment
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @param Attachment\RgaUuid $rgaUuid
	 * @return Attachment
	 */
	public function setRgaUuid(Attachment\RgaUuid $rgaUuid): Attachment
	{
		$this->rgaUuid = $rgaUuid;
		
		return $this;
	}
	
	/**
	 * @param Attachment\FileType $fileType
	 * @return Attachment
	 */
	public function setFileType(Attachment\FileType $fileType): Attachment
	{
		$this->fileType = $fileType;
		
		return $this;
	}
	
	/**
	 * @param Attachment\FileName $fileName
	 * @return Attachment
	 */
	public function setFileName(Attachment\FileName $fileName): Attachment
	{
		$this->fileName = $fileName;
		
		return $this;
	}
	
	/**
	 * @param Attachment\OriginalFileName $originalFileName
	 * @return Attachment
	 */
	public function setOriginalFileName(Attachment\OriginalFileName $originalFileName): Attachment
	{
		$this->originalFileName = $originalFileName;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setAggregateId($id): void
	{
		$this->setUuid(VO\Uuid::fromString($id));
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
		VO\Uuid $uuid,
		VO\RgaUuid $rgaUuid,
		VO\FileType $fileType,
		VO\FileName $fileName,
		VO\OriginalFileName $originalFileName
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