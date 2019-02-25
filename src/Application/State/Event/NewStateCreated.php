<?php

namespace RGA\Application\State\Event;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewStateCreated
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return State\Uuid
	 */
	public function stateUuid(): State\Uuid
	{
		return State\Uuid::fromString($this->aggregateId());
	}
	
	/**
	 * @return State\IsEditable
	 */
	public function stateIsEditable(): State\IsEditable
	{
		return State\IsEditable::fromBoolean((bool)($this->payload['editable'] ?? false));
	}
	
	/**
	 * @return State\IsDeletable
	 */
	public function stateIsDeletable(): State\IsDeletable
	{
		return State\IsDeletable::fromBoolean((bool)($this->payload['deletable'] ?? false));
	}
	
	/**
	 * @return State\IsRejectable
	 */
	public function stateIsRejectable(): State\IsRejectable
	{
		return State\IsRejectable::fromBoolean((bool)($this->payload['rejectable'] ?? false));
	}
	
	/**
	 * @return State\IsFinishable
	 */
	public function stateIsFinishable(): State\IsFinishable
	{
		return State\IsFinishable::fromBoolean((bool)($this->payload['finishable'] ?? false));
	}
	
	/**
	 * @return State\IsCloseable
	 */
	public function stateIsCloseable(): State\IsCloseable
	{
		return State\IsCloseable::fromBoolean((bool)($this->payload['closeable'] ?? false));
	}
	
	/**
	 * @return State\IsSendingEmail
	 */
	public function stateIsSendingEmail(): State\IsSendingEmail
	{
		return State\IsSendingEmail::fromBoolean((bool)($this->payload['sending_email'] ?? false));
	}
	
	/**
	 * @return State\ColorCode
	 */
	public function stateColorCode(): State\ColorCode
	{
		return State\ColorCode::fromString((string)($this->payload['color_code'] ?? ''));
	}
	
	/**
	 * @return State\Names
	 */
	public function stateNames(): State\Names
	{
		return State\Names::fromArray((array)($this->payload['names'] ? \unserialize($this->payload['names'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @return State\EmailSubjects
	 */
	public function stateEmailSubjects(): State\EmailSubjects
	{
		return State\EmailSubjects::fromArray((array)($this->payload['email_subjects'] ? \unserialize($this->payload['email_subjects'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @return State\EmailBodies
	 */
	public function stateEmailBodies(): State\EmailBodies
	{
		return State\EmailBodies::fromArray((array)($this->payload['email_bodies'] ? \unserialize($this->payload['email_bodies'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|State $state
	 */
	public function populate(Aggregate\AggregateRoot $state): void
	{
		$state->setUuid($this->stateUuid());
		$state->setIsEditable($this->stateIsEditable());
		$state->setIsDeletable($this->stateIsDeletable());
		$state->setIsRejectable($this->stateIsRejectable());
		$state->setIsFinishable($this->stateIsFinishable());
		$state->setIsCloseable($this->stateIsCloseable());
		$state->setIsSendingEmail($this->stateIsSendingEmail());
		$state->setColorCode($this->stateColorCode());
		$state->setNames($this->stateNames());
		$state->setEmailSubjects($this->stateEmailSubjects());
		$state->setEmailBodies($this->stateEmailBodies());
	}
}