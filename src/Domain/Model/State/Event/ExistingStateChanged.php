<?php

namespace RGA\Domain\Model\State\Event;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingStateChanged
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return State\IsEditable
	 */
	public function stateIsEditable(): State\IsEditable
	{
		return State\IsEditable::fromBoolean((bool)($this->payload['is_editable'] ?? false));
	}
	
	/**
	 * @return State\IsDeletable
	 */
	public function stateIsDeletable(): State\IsDeletable
	{
		return State\IsDeletable::fromBoolean((bool)($this->payload['is_deletable'] ?? false));
	}
	
	/**
	 * @return State\IsRejectable
	 */
	public function stateIsRejectable(): State\IsRejectable
	{
		return State\IsRejectable::fromBoolean((bool)($this->payload['is_rejectable'] ?? false));
	}
	
	/**
	 * @return State\IsFinishable
	 */
	public function stateIsFinishable(): State\IsFinishable
	{
		return State\IsFinishable::fromBoolean((bool)($this->payload['is_finishable'] ?? false));
	}
	
	/**
	 * @return State\IsCloseable
	 */
	public function stateIsCloseable(): State\IsCloseable
	{
		return State\IsCloseable::fromBoolean((bool)($this->payload['is_closeable'] ?? false));
	}
	
	/**
	 * @return State\IsSendingEmail
	 */
	public function stateIsSendingEmail(): State\IsSendingEmail
	{
		return State\IsSendingEmail::fromBoolean((bool)($this->payload['is_sending_email'] ?? false));
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
		return State\Names::fromArray((array)(\json_decode($this->payload['names'], true) ?? []));
	}
	
	/**
	 * @return State\EmailSubjects
	 */
	public function stateEmailSubjects(): State\EmailSubjects
	{
		return State\EmailSubjects::fromArray((array)(\json_decode($this->payload['email_subjects'], true) ?? []));
	}
	
	/**
	 * @return State\EmailBodies
	 */
	public function stateEmailBodies(): State\EmailBodies
	{
		return State\EmailBodies::fromArray((array)(\json_decode($this->payload['email_bodies'], true) ?? []));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|State $state
	 */
	public function populate(Aggregate\AggregateRoot $state): void
	{
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