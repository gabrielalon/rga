<?php

namespace RGA\Domain\Model\State\Builder;

use function array_filter;
use function array_keys;
use function array_merge;
use RGA\Domain\Model\State\State as Entity;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class State
{
	/** @var Entity */
	private $entity;
	
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}
	
	/**
	 * @param string $uuid
	 * @return State
	 */
	public static function init($uuid)
	{
		$entity = new Entity();
		$entity->setUuid($uuid);
		
		return new State($entity);
	}
	
	/**
	 * @param bool $isEditable
	 */
	public function setIsEditable(bool $isEditable): void
	{
		$this->entity->setIsEditable(new ValueObject\State\IsEditable($isEditable));
	}
	
	/**
	 * @param bool $isDeletable
	 */
	public function setIsDeletable(bool $isDeletable): void
	{
		$this->entity->setIsDeletable(new ValueObject\State\IsDeletable($isDeletable));
	}
	
	/**
	 * @param bool $isRejectable
	 */
	public function setIsRejectable(bool $isRejectable): void
	{
		$this->entity->setIsRejectable(new ValueObject\State\IsRejectable($isRejectable));
	}
	
	/**
	 * @param bool $isFinishable
	 */
	public function setIsFinishable(bool $isFinishable): void
	{
		$this->entity->setIsFinishable(new ValueObject\State\IsFinishable($isFinishable));
	}
	
	/**
	 * @param bool $isCloseable
	 */
	public function setIsCloseable(bool $isCloseable): void
	{
		$this->entity->setIsCloseable(new ValueObject\State\IsCloseable($isCloseable));
	}
	
	/**
	 * @param bool $isSendingEmail
	 */
	public function setIsSendingEmail(bool $isSendingEmail): void
	{
		$this->entity->setIsSendingEmail(new ValueObject\State\IsSendingEmail($isSendingEmail));
	}
	
	/**
	 * @param string $colorCode
	 */
	public function setColorCode(string $colorCode): void
	{
		$this->entity->setColorCode(new ValueObject\State\ColorCode($colorCode));
	}
	
	/**
	 * @param array $names
	 * @param array $emailSubjects
	 * @param array $emailBodies
	 */
	public function setLocale(array $names, array $emailSubjects, array $emailBodies): void
	{
		$locales = array_filter(array_merge(
			array_keys($names),
			array_keys($emailSubjects),
			array_keys($emailBodies)
		));
		
		$collection = new Translate\LocaleCollector();
		
		foreach ($locales as $locale)
		{
			$builder = new StateLocale($locale);
			$builder->setName($names[$locale] ?? '');
			$builder->setEmailSubject($emailSubjects[$locale] ?? '');
			$builder->setEmailBody($emailBodies[$locale] ?? '');
			
			$collection->add($builder->build());
		}
		
		$this->entity->setLocales($collection);
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}