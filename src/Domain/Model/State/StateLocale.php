<?php

namespace RGA\Domain\Model\State;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class StateLocale
	implements Translate\Translatable
{
	use Translate\Translated;
	
	/** @var string */
	private $name;
	
	/** @var string */
	private $emailSubject;
	
	/** @var string */
	private $emailBody;
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @param ValueObject\State\Name $name
	 */
	public function setName(ValueObject\State\Name $name): void
	{
		$this->name = $name->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getEmailSubject(): string
	{
		return $this->emailSubject;
	}
	
	/**
	 * @param ValueObject\State\EmailSubject $emailSubject
	 */
	public function setEmailSubject(ValueObject\State\EmailSubject $emailSubject): void
	{
		$this->emailSubject = $emailSubject->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getEmailBody(): string
	{
		return $this->emailBody;
	}
	
	/**
	 * @param ValueObject\State\EmailBody $emailBody
	 */
	public function setEmailBody(ValueObject\State\EmailBody $emailBody): void
	{
		$this->emailBody = $emailBody->getValue();
	}
}