<?php

namespace RGA\Test\Mock\Entity\State;

use RGA\Domain\Model\State\State as ValueObject;

class State
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\IsEditable */
	private $isEditable;
	
	/** @var ValueObject\IsDeletable */
	private $isDeletable;
	
	/** @var ValueObject\IsRejectable */
	private $isRejectable;
	
	/** @var ValueObject\IsFinishable */
	private $isFinishable;
	
	/** @var ValueObject\IsCloseable */
	private $isCloseable;
	
	/** @var ValueObject\IsSendingEmail */
	private $isSendingEmail;
	
	/** @var ValueObject\ColorCode */
	private $colorCode;
	
	/** @var ValueObject\Names */
	private $names;
	
	/** @var ValueObject\EmailSubjects */
	private $emailSubjects;
	
	/** @var ValueObject\EmailBodies */
	private $emailBodies;
	
	/**
	 * @return ValueObject\Uuid
	 */
	public function getUuid(): ValueObject\Uuid
	{
		return $this->uuid;
	}
	
	/**
	 * @param ValueObject\Uuid $uuid
	 * @return State
	 */
	public function setUuid(ValueObject\Uuid $uuid): State
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsEditable
	 */
	public function isEditable(): ValueObject\IsEditable
	{
		return $this->isEditable;
	}
	
	/**
	 * @param ValueObject\IsEditable $isEditable
	 * @return State
	 */
	public function setIsEditable(ValueObject\IsEditable $isEditable): State
	{
		$this->isEditable = $isEditable;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsDeletable
	 */
	public function isDeletable(): ValueObject\IsDeletable
	{
		return $this->isDeletable;
	}
	
	/**
	 * @param ValueObject\IsDeletable $isDeletable
	 * @return State
	 */
	public function setIsDeletable(ValueObject\IsDeletable $isDeletable): State
	{
		$this->isDeletable = $isDeletable;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsRejectable
	 */
	public function isRejectable(): ValueObject\IsRejectable
	{
		return $this->isRejectable;
	}
	
	/**
	 * @param ValueObject\IsRejectable $isRejectable
	 * @return State
	 */
	public function setIsRejectable(ValueObject\IsRejectable $isRejectable): State
	{
		$this->isRejectable = $isRejectable;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsFinishable
	 */
	public function isFinishable(): ValueObject\IsFinishable
	{
		return $this->isFinishable;
	}
	
	/**
	 * @param ValueObject\IsFinishable $isFinishable
	 * @return State
	 */
	public function setIsFinishable(ValueObject\IsFinishable $isFinishable): State
	{
		$this->isFinishable = $isFinishable;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsCloseable
	 */
	public function isCloseable(): ValueObject\IsCloseable
	{
		return $this->isCloseable;
	}
	
	/**
	 * @param ValueObject\IsCloseable $isCloseable
	 * @return State
	 */
	public function setIsCloseable(ValueObject\IsCloseable $isCloseable): State
	{
		$this->isCloseable = $isCloseable;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsSendingEmail
	 */
	public function isSendingEmail(): ValueObject\IsSendingEmail
	{
		return $this->isSendingEmail;
	}
	
	/**
	 * @param ValueObject\IsSendingEmail $isSendingEmail
	 * @return State
	 */
	public function setIsSendingEmail(ValueObject\IsSendingEmail $isSendingEmail): State
	{
		$this->isSendingEmail = $isSendingEmail;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ColorCode
	 */
	public function getColorCode(): ValueObject\ColorCode
	{
		return $this->colorCode;
	}
	
	/**
	 * @param ValueObject\ColorCode $colorCode
	 * @return State
	 */
	public function setColorCode(ValueObject\ColorCode $colorCode): State
	{
		$this->colorCode = $colorCode;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Names
	 */
	public function getNames(): ValueObject\Names
	{
		return $this->names;
	}
	
	/**
	 * @param ValueObject\Names $names
	 * @return State
	 */
	public function setNames(ValueObject\Names $names): State
	{
		$this->names = $names;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\EmailSubjects
	 */
	public function getEmailSubjects(): ValueObject\EmailSubjects
	{
		return $this->emailSubjects;
	}
	
	/**
	 * @param ValueObject\EmailSubjects $emailSubjects
	 * @return State
	 */
	public function setEmailSubjects(ValueObject\EmailSubjects $emailSubjects): State
	{
		$this->emailSubjects = $emailSubjects;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\EmailBodies
	 */
	public function getEmailBodies(): ValueObject\EmailBodies
	{
		return $this->emailBodies;
	}
	
	/**
	 * @param ValueObject\EmailBodies $emailBodies
	 * @return State
	 */
	public function setEmailBodies(ValueObject\EmailBodies $emailBodies): State
	{
		$this->emailBodies = $emailBodies;
		
		return $this;
	}
}