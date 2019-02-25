<?php

namespace RGA\Test\Application\Additional;

use RGA\Domain\Model\Additional\Additional as ValueObject;
use RGA\Domain\Model\Additional\Additional;
use RGA\Application\Additional\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Application\AggregateChangedTestCase;

class AdditionalTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\RgaUuid */
	private $rgaUuid;
	
	/** @var ValueObject\ServiceType */
	private $serviceType;
	
	/** @var ValueObject\ServiceData */
	private $serviceData;
	
	
	protected function setUp()
	{
		$this->rgaUuid = ValueObject\RgaUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->serviceType = ValueObject\ServiceType::fromString('test');
		$this->serviceData = ValueObject\ServiceData::fromArray(['outpost_id' => 12]);
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_Additional()
	{
		$Additional = Additional::createNewAdditional(
			$this->rgaUuid,
			$this->serviceType,
			$this->serviceData
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($Additional);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewAdditionalCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewAdditionalCreated::class, $event->messageName());
		$this->assertTrue($this->rgaUuid->equals($event->AdditionalRgaUuid()));
		$this->assertTrue($this->serviceType->equals($event->additionalServiceType()));
		$this->assertTrue($this->serviceData->equals($event->additionalServiceData()));
	}
}