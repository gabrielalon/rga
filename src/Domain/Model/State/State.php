<?php

namespace RGA\Domain\Model\State;

use RGA\Domain\Model\State\State as ValueObject;
use RGA\Domain\Model\State\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class State
	extends Aggregate\AggregateRoot
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
	 * @param State\Uuid $uuid
	 */
	public function setUuid(State\Uuid $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @param State\IsEditable $isEditable
	 */
	public function setIsEditable(State\IsEditable $isEditable): void
	{
		$this->isEditable = $isEditable;
	}
	
	/**
	 * @param State\IsDeletable $isDeletable
	 */
	public function setIsDeletable(State\IsDeletable $isDeletable): void
	{
		$this->isDeletable = $isDeletable;
	}
	
	/**
	 * @param State\IsRejectable $isRejectable
	 */
	public function setIsRejectable(State\IsRejectable $isRejectable): void
	{
		$this->isRejectable = $isRejectable;
	}
	
	/**
	 * @param State\IsFinishable $isFinishable
	 */
	public function setIsFinishable(State\IsFinishable $isFinishable): void
	{
		$this->isFinishable = $isFinishable;
	}
	
	/**
	 * @param State\IsCloseable $isCloseable
	 */
	public function setIsCloseable(State\IsCloseable $isCloseable): void
	{
		$this->isCloseable = $isCloseable;
	}
	
	/**
	 * @param State\IsSendingEmail $isSendingEmail
	 */
	public function setIsSendingEmail(State\IsSendingEmail $isSendingEmail): void
	{
		$this->isSendingEmail = $isSendingEmail;
	}
	
	/**
	 * @param State\ColorCode $colorCode
	 */
	public function setColorCode(State\ColorCode $colorCode): void
	{
		$this->colorCode = $colorCode;
	}
	
	/**
	 * @param State\Names $names
	 */
	public function setNames(State\Names $names): void
	{
		$this->names = $names;
	}
	
	/**
	 * @param State\EmailSubjects $emailSubjects
	 */
	public function setEmailSubjects(State\EmailSubjects $emailSubjects): void
	{
		$this->emailSubjects = $emailSubjects;
	}
	
	/**
	 * @param State\EmailBodies $emailBodies
	 */
	public function setEmailBodies(State\EmailBodies $emailBodies): void
	{
		$this->emailBodies = $emailBodies;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * @param State\Uuid $uuid
	 * @param State\IsEditable $isEditable
	 * @param State\IsDeletable $isDeletable
	 * @param State\IsRejectable $isRejectable
	 * @param State\IsFinishable $isFinishable
	 * @param State\IsCloseable $isCloseable
	 * @param State\IsSendingEmail $isSendingEmail
	 * @param State\ColorCode $colorCode
	 * @param State\Names $names
	 * @param State\EmailSubjects $emailSubjects
	 * @param State\EmailBodies $emailBodies
	 * @return State
	 */
	public static function createNewState(
		ValueObject\Uuid $uuid,
		ValueObject\IsEditable $isEditable,
		ValueObject\IsDeletable $isDeletable,
		ValueObject\IsRejectable $isRejectable,
		ValueObject\IsFinishable $isFinishable,
		ValueObject\IsCloseable $isCloseable,
		ValueObject\IsSendingEmail $isSendingEmail,
		ValueObject\ColorCode $colorCode,
		ValueObject\Names $names,
		ValueObject\EmailSubjects $emailSubjects,
		ValueObject\EmailBodies $emailBodies
	): State
	{
		$state = new State();
		
		$state->recordThat(Event\NewStateCreated::occur($uuid->toString(), [
			'editable'       => $isEditable->toString(),
			'deletable'      => $isDeletable->toString(),
			'rejectable'     => $isRejectable->toString(),
			'finishable'     => $isFinishable->toString(),
			'closeable'      => $isCloseable->toString(),
			'sending_email'  => $isSendingEmail->toString(),
			'color_code'     => $colorCode->toString(),
			'names'          => $names->toString(),
			'email_subjects' => $emailSubjects->toString(),
			'email_bodies'   => $emailBodies->toString()
		]));
		
		return $state;
	}
	
	/**
	 * @param State\IsEditable $isEditable
	 * @param State\IsDeletable $isDeletable
	 * @param State\IsRejectable $isRejectable
	 * @param State\IsFinishable $isFinishable
	 * @param State\IsCloseable $isCloseable
	 * @param State\IsSendingEmail $isSendingEmail
	 * @param State\ColorCode $colorCode
	 * @param State\Names $names
	 * @param State\EmailSubjects $emailSubjects
	 * @param State\EmailBodies $emailBodies
	 */
	public function changeExistingState(
		ValueObject\IsEditable $isEditable,
		ValueObject\IsDeletable $isDeletable,
		ValueObject\IsRejectable $isRejectable,
		ValueObject\IsFinishable $isFinishable,
		ValueObject\IsCloseable $isCloseable,
		ValueObject\IsSendingEmail $isSendingEmail,
		ValueObject\ColorCode $colorCode,
		ValueObject\Names $names,
		ValueObject\EmailSubjects $emailSubjects,
		ValueObject\EmailBodies $emailBodies
	): void
	{
		$this->recordThat(Event\ExistingStateChanged::occur($this->aggregateId(), [
			'editable'       => $isEditable->toString(),
			'deletable'      => $isDeletable->toString(),
			'rejectable'     => $isRejectable->toString(),
			'finishable'     => $isFinishable->toString(),
			'closeable'      => $isCloseable->toString(),
			'sending_email'  => $isSendingEmail->toString(),
			'color_code'     => $colorCode->toString(),
			'names'          => $names->toString(),
			'email_subjects' => $emailSubjects->toString(),
			'email_bodies'   => $emailBodies->toString()
		]));
	}
	
	public function removeExistingState(): void
	{
		$this->recordThat(Event\ExistingStateRemoved::occur($this->aggregateId(), []));
	}
}