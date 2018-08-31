<?php

namespace RGA\Test\Domain\Model\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary as ValueObject;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\Dictionary\Enum;
use RGA\Domain\Model\Dictionary\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Domain\Model\AggregateChangedTestCase;

class DictionaryTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Type */
	private $type;
	
	/** @var ValueObject\Entries */
	private $values;
	
	protected function setUp()
	{
		$this->uuid = ValueObject\Uuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->type = ValueObject\Type::fromString(Enum\Type::__default);
		$this->values = ValueObject\Entries::fromArray(['pl' => 'test', 'en' => 'testowo']);
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_dictionary()
	{
		$dictionary = Dictionary::createNewDictionary($this->uuid, $this->type, $this->values);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($dictionary);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewDictionaryCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewDictionaryCreated::class, $event->messageName());
		$this->assertTrue($this->uuid->equals($event->dictionaryUuid()));
		$this->assertTrue($this->type->equals($event->dictionaryType()));
		$this->assertTrue($this->values->equals($event->dictionaryValues()));
	}
	
	/**
	 * @test
	 */
	public function it_changes_existing_dictionary()
	{
		$dictionary = $this->reconstituteDictionaryFromHistory($this->newDictionaryCreated());
		
		$values = ValueObject\Entries::fromArray(['pl' => 'testowo', 'en' => 'test']);
		
		$dictionary->changeExistingDictionary($values);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($dictionary);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ExistingDictionaryChanged $event */
		$event = $events[0];
		
		$this->assertSame(Event\ExistingDictionaryChanged::class, $event->messageName());
		$this->assertTrue($values->equals($event->dictionaryValues()));
	}
	
	/**
	 * @param AggregateChanged ...$events
	 * @return object|Dictionary
	 */
	private function reconstituteDictionaryFromHistory(AggregateChanged ...$events)
	{
		return $this->reconstituteAggregateFromHistory(
			\RGA\Domain\Model\Dictionary\Dictionary::class,
			$events
		);
	}
	
	/**
	 * @return AggregateChanged|Dictionary
	 */
	private function newDictionaryCreated()
	{
		return Event\NewDictionaryCreated::occur($this->uuid->toString(), [
			'type' => $this->type->toString(),
			'values' => $this->values->toString()
		]);
	}
}