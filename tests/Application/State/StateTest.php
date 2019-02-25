<?php

namespace RGA\Test\Application\State;

use RGA\Domain\Model\State\State as ValueObject;
use RGA\Domain\Model\State\State;
use RGA\Application\State\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Application\AggregateChangedTestCase;

class StateTest
	extends AggregateChangedTestCase
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
	
	protected function setUp()
	{
		$this->uuid = ValueObject\Uuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->names = ValueObject\Names::fromArray(['pl' => 'Nazwa', 'en' => 'Name']);
		$this->emailSubjects = ValueObject\EmailSubjects::fromArray(['pl' => 'Temat', 'en' => 'Subject']);
		$this->emailBodies = ValueObject\EmailBodies::fromArray(['pl' => 'Treść', 'en' => 'Body']);
		$this->isEditable = ValueObject\IsEditable::fromBoolean(true);
		$this->isDeletable = ValueObject\IsDeletable::fromBoolean(true);
		$this->isRejectable = ValueObject\IsRejectable::fromBoolean(true);
		$this->isFinishable = ValueObject\IsFinishable::fromBoolean(true);
		$this->isCloseable = ValueObject\IsCloseable::fromBoolean(true);
		$this->isSendingEmail = ValueObject\IsSendingEmail::fromBoolean(true);
		$this->colorCode = ValueObject\ColorCode::fromString('#000000');
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_state()
	{
		$state = State::createNewState(
			$this->uuid,
			$this->isEditable,
			$this->isDeletable,
			$this->isRejectable,
			$this->isFinishable,
			$this->isCloseable,
			$this->isSendingEmail,
			$this->colorCode,
			$this->names,
			$this->emailSubjects,
			$this->emailBodies
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($state);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewStateCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewStateCreated::class, $event->messageName());
		$this->assertTrue($this->uuid->equals($event->stateUuid()));
		$this->assertTrue($this->isEditable->equals($event->stateIsEditable()));
		$this->assertTrue($this->isDeletable->equals($event->stateIsDeletable()));
		$this->assertTrue($this->isRejectable->equals($event->stateIsRejectable()));
		$this->assertTrue($this->isFinishable->equals($event->stateIsFinishable()));
		$this->assertTrue($this->isCloseable->equals($event->stateIsCloseable()));
		$this->assertTrue($this->isSendingEmail->equals($event->stateIsSendingEmail()));
		$this->assertTrue($this->colorCode->equals($event->stateColorCode()));
		$this->assertTrue($this->names->equals($event->stateNames()));
		$this->assertTrue($this->emailSubjects->equals($event->stateEmailSubjects()));
		$this->assertTrue($this->emailBodies->equals($event->stateEmailBodies()));
	}
	
	/**
	 * @test
	 */
	public function it_changes_existing_state()
	{
		$state = $this->reconstituteStateFromHistory($this->newStateCreated());
		
		$names = ValueObject\Names::fromArray(['pl' => 'Nazwa test', 'en' => 'Name test']);
		$emailSubjects = ValueObject\EmailSubjects::fromArray(['pl' => 'Temat test', 'en' => 'Subject test']);
		$emailBodies = ValueObject\EmailBodies::fromArray(['pl' => 'Treść test', 'en' => 'Body test']);
		$isEditable = ValueObject\IsEditable::fromBoolean(false);
		$isDeletable = ValueObject\IsDeletable::fromBoolean(false);
		$isRejectable = ValueObject\IsRejectable::fromBoolean(false);
		$isFinishable = ValueObject\IsFinishable::fromBoolean(false);
		$isCloseable = ValueObject\IsCloseable::fromBoolean(false);
		$isSendingEmail = ValueObject\IsSendingEmail::fromBoolean(false);
		$colorCode = ValueObject\ColorCode::fromString('#000001');
		
		$state->changeExistingState(
			$isEditable,
			$isDeletable,
			$isRejectable,
			$isFinishable,
			$isCloseable,
			$isSendingEmail,
			$colorCode,
			$names,
			$emailSubjects,
			$emailBodies
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($state);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ExistingStateChanged $event */
		$event = $events[0];
		
		$this->assertSame(Event\ExistingStateChanged::class, $event->messageName());
		$this->assertTrue($isEditable->equals($event->stateIsEditable()));
		$this->assertTrue($isDeletable->equals($event->stateIsDeletable()));
		$this->assertTrue($isRejectable->equals($event->stateIsRejectable()));
		$this->assertTrue($isFinishable->equals($event->stateIsFinishable()));
		$this->assertTrue($isCloseable->equals($event->stateIsCloseable()));
		$this->assertTrue($isSendingEmail->equals($event->stateIsSendingEmail()));
		$this->assertTrue($colorCode->equals($event->stateColorCode()));
		$this->assertTrue($names->equals($event->stateNames()));
		$this->assertTrue($emailSubjects->equals($event->stateEmailSubjects()));
		$this->assertTrue($emailBodies->equals($event->stateEmailBodies()));
	}
	
	/**
	 * @param AggregateChanged ...$events
	 * @return object|State
	 */
	private function reconstituteStateFromHistory(AggregateChanged ...$events)
	{
		return $this->reconstituteAggregateFromHistory(
			\RGA\Domain\Model\State\State::class,
			$events
		);
	}
	
	/**
	 * @return AggregateChanged|State
	 */
	private function newStateCreated()
	{
		return Event\NewStateCreated::occur($this->uuid->toString(), [
			'editable'       => $this->isEditable->toString(),
			'deletable'      => $this->isDeletable->toString(),
			'rejectable'     => $this->isRejectable->toString(),
			'finishable'     => $this->isFinishable->toString(),
			'closeable'      => $this->isCloseable->toString(),
			'sending_email'  => $this->isSendingEmail->toString(),
			'color_code'     => $this->colorCode->toString(),
			'names'          => $this->names->toString(),
			'email_subjects' => $this->emailSubjects->toString(),
			'email_bodies'   => $this->emailBodies->toString()
		]);
	}
}