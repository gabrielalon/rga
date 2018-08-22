<?php

namespace RGA\Domain\Model\State\Builder;

use RGA\Domain\Model\State\StateLocale as Entity;
use RGA\Domain\ValueObject;

class StateLocale
{
	/** @var Entity */
	private $entity;
	
	/**
	 * @param string $locale
	 */
	public function __construct($locale)
	{
		$this->entity = new Entity();
		$this->entity->setLocale($locale);
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name): void
	{
		$this->entity->setName(new ValueObject\State\Name($name));
	}
	
	/**
	 * @param string $emailSubject
	 */
	public function setEmailSubject($emailSubject): void
	{
		$this->entity->setEmailSubject(new ValueObject\State\EmailSubject($emailSubject));
	}
	
	/**
	 * @param string $emailBody
	 */
	public function setEmailBody($emailBody): void
	{
		$this->entity->setEmailBody(new ValueObject\State\EmailBody($emailBody));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		return $this->entity;
	}
}