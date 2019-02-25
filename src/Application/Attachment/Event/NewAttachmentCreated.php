<?php

namespace RGA\Application\Attachment\Event;

use RGA\Domain\Model\Attachment\Attachment;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewAttachmentCreated
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Attachment\Uuid
	 */
	public function attachmentUuid(): Attachment\Uuid
	{
		return Attachment\Uuid::fromString($this->aggregateId());
	}
	
	/**
	 * @return Attachment\RgaUuid
	 */
	public function attachmentRgaUuid(): Attachment\RgaUuid
	{
		return Attachment\RgaUuid::fromString((string)($this->payload['rga_uuid'] ?? ''));
	}
	
	/**
	 * @return Attachment\FileType
	 */
	public function attachmentFileType(): Attachment\FileType
	{
		return Attachment\FileType::fromString((string)($this->payload['file_type'] ?? ''));
	}
	
	/**
	 * @return Attachment\FileName
	 */
	public function attachmentFileName(): Attachment\FileName
	{
		return Attachment\FileName::fromString((string)($this->payload['file_name'] ?? ''));
	}
	
	/**
	 * @return Attachment\OriginalFileName
	 */
	public function attachmentOriginalFileName(): Attachment\OriginalFileName
	{
		return Attachment\OriginalFileName::fromString((string)($this->payload['original_file_name'] ?? ''));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Attachment $attachment
	 */
	public function populate(Aggregate\AggregateRoot $attachment): void
	{
		$attachment->setUuid($this->attachmentUuid());
		$attachment->setRgaUuid($this->attachmentRgaUuid());
		$attachment->setFileName($this->attachmentFileName());
		$attachment->setFileType($this->attachmentFileType());
		$attachment->setOriginalFileName($this->attachmentOriginalFileName());
	}
}