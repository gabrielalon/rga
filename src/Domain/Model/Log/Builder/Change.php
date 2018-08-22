<?php

namespace RGA\Domain\Model\Log\Builder;

use RGA\Domain\Model\Log\Change as Entity;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Log\Blamable\AdminInterface;
use RGA\Infrastructure\Log\Type\LogTypeInterface;

class Change
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
	 * @return Change
	 */
	public static function init($rgaUuid): Change
	{
		$entity = new Entity();
		$entity->setRgaUuid(new ValueObject\Log\RgaUuid($rgaUuid));
		$entity->setRecordedOn(new ValueObject\Log\RecordedOn('now'));
		
		return new Change($entity);
	}
	
	/**
	 * @param LogTypeInterface $type
	 */
	public function setType(LogTypeInterface $type): void
	{
		$this->entity->setType(new ValueObject\Log\Type($type->getType()));
	}
	
	/**
	 * @param array $metadata
	 */
	public function setMetadata(array $metadata = []): void
	{
		$this->entity->setMetadata(new ValueObject\Log\Metadata($metadata));
	}
	
	/**
	 * @param AdminInterface $admin
	 */
	public function setAdmin(AdminInterface $admin): void
	{
		$this->entity->setAdminName(new ValueObject\Log\AdminName($admin->getFullName()));
		$this->entity->setAdminID(new ValueObject\Log\AdminID($admin->getReferenceID()));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}