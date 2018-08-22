<?php

namespace RGA\Domain\Model\Attachment\Builder;

use RGA\Domain\Model\Attachment\Attachment as Entity;
use RGA\Domain\ValueObject;

class Attachment
{
	/** @var Entity */
	private $entity;
	
	/**
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}
	
	/**
	 * @param string $rgaUuid
	 * @return Attachment
	 */
	public static function init($rgaUuid): Attachment
	{
		$entity = new Entity();
		$entity->setRgaUuid(new ValueObject\Attachment\RgaUuid($rgaUuid));
		
		return new Attachment($entity);
	}
	
	/**
	 * @param ValueObject\Base\Attachment $attachment
	 */
	public function setAttachment(ValueObject\Base\Attachment $attachment): void
	{
		$this->entity->setOriginalFileName(new ValueObject\Attachment\OriginalFileName($attachment->getFileOriginalName()));
		$this->entity->setFileType(new ValueObject\Attachment\FileType($attachment->getFileType()));
		$this->entity->setFileName(new ValueObject\Attachment\FileName($attachment->getFileType()));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}