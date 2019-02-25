<?php

namespace RGA\Test\Application\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour as ValueObject;
use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Application\Behaviour\Enum;
use RGA\Application\Behaviour\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Application\AggregateChangedTestCase;

class BehaviourTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Type */
	private $type;
	
	/** @var ValueObject\Names */
	private $names;
	
	/** @var ValueObject\Active */
	private $activation;
	
	protected function setUp()
	{
		$this->uuid = ValueObject\Uuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->type = ValueObject\Type::fromString(Enum\Type::__default);
		$this->names = ValueObject\Names::fromArray(['pl' => 'Reklamacja', 'en' => 'Complaint']);
		$this->activation = ValueObject\Active::fromBoolean(true);
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_behaviour()
	{
		$behaviour = Behaviour::createNewBehaviour($this->uuid, $this->type, $this->names, $this->activation);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($behaviour);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewBehaviourCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewBehaviourCreated::class, $event->messageName());
		$this->assertTrue($this->uuid->equals($event->behaviourUuid()));
		$this->assertTrue($this->type->equals($event->behaviourType()));
		$this->assertTrue($this->names->equals($event->behaviourNames()));
		$this->assertTrue($this->activation->equals($event->behaviourActivation()));
	}
	
	/**
	 * @test
	 */
	public function it_changes_existing_behaviour()
	{
		$behaviour = $this->reconstituteBehaviourFromHistory($this->newBehaviourCreated());
		
		$names = ValueObject\Names::fromArray(['pl' => 'Reklamacje', 'en' => 'Complaints']);
		$activation = ValueObject\Active::fromBoolean(false);
		
		$behaviour->changeExistingBehaviour($names, $activation);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($behaviour);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ExistingBehaviourChanged $event */
		$event = $events[0];
		
		$this->assertSame(Event\ExistingBehaviourChanged::class, $event->messageName());
		$this->assertTrue($names->equals($event->behaviourNames()));
		$this->assertTrue($activation->equals($event->behaviourActivation()));
	}
	
	/**
	 * @param AggregateChanged ...$events
	 * @return object|Behaviour
	 */
	private function reconstituteBehaviourFromHistory(AggregateChanged ...$events)
	{
		return $this->reconstituteAggregateFromHistory(
			\RGA\Domain\Model\Behaviour\Behaviour::class,
			$events
		);
	}
	
	/**
	 * @return AggregateChanged|Behaviour
	 */
	private function newBehaviourCreated()
	{
		return Event\NewBehaviourCreated::occur($this->uuid->toString(), [
			'type' => $this->type->toString(),
			'names' => $this->names->toString(),
			'activation' => $this->activation->toString()
		]);
	}
}