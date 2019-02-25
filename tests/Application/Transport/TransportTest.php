<?php

namespace RGA\Test\Application\Transport;

use RGA\Domain\Model\Transport\Transport as ValueObject;
use RGA\Domain\Model\Transport\Transport;
use RGA\Application\Transport\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Application\AggregateChangedTestCase;

class TransportTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Active */
	private $activation;
	
	/** @var ValueObject\ShipmentId */
	private $shipmentId;
	
	/** @var ValueObject\Domains */
	private $domains;
	
	/** @var ValueObject\Names */
	private $names;
	
	protected function setUp()
	{
		$this->uuid = ValueObject\Uuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->activation = Transport\Active::fromBoolean(true);
		$this->shipmentId = Transport\ShipmentId::fromInteger(1);
		$this->domains = Transport\Domains::fromArray(['test.pl']);
		$this->names = ValueObject\Names::fromArray(['pl' => 'Nazwa', 'en' => 'Name']);
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_transport()
	{
		$transport = Transport::createNewTransport(
			$this->uuid,
			$this->activation,
			$this->shipmentId,
			$this->domains,
			$this->names
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($transport);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewTransportCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewTransportCreated::class, $event->messageName());
		$this->assertTrue($this->uuid->equals($event->transportUuid()));
		$this->assertTrue($this->activation->equals($event->transportActivation()));
		$this->assertTrue($this->shipmentId->equals($event->transportShipmentId()));
		$this->assertTrue($this->domains->equals($event->transportDomains()));
		$this->assertTrue($this->names->equals($event->transportNames()));
	}
	
	/**
	 * @test
	 */
	public function it_changes_existing_transport()
	{
		$transport = $this->reconstituteTransportFromHistory($this->newTransportCreated());
		
		$activation = Transport\Active::fromBoolean(false);
		$shipmentId = Transport\ShipmentId::fromInteger(2);
		$domains = Transport\Domains::fromArray(['testowo.pl']);
		$names = ValueObject\Names::fromArray(['pl' => 'Nazwa test', 'en' => 'Name test']);
		
		$transport->changeExistingTransport(
			$activation,
			$shipmentId,
			$domains,
			$names
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($transport);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ExistingTransportChanged $event */
		$event = $events[0];
		
		$this->assertSame(Event\ExistingTransportChanged::class, $event->messageName());
		$this->assertTrue($activation->equals($event->transportActivation()));
		$this->assertTrue($shipmentId->equals($event->transportShipmentId()));
		$this->assertTrue($domains->equals($event->transportDomains()));
		$this->assertTrue($names->equals($event->transportNames()));
	}
	
	/**
	 * @param AggregateChanged ...$events
	 * @return object|Transport
	 */
	private function reconstituteTransportFromHistory(AggregateChanged ...$events)
	{
		return $this->reconstituteAggregateFromHistory(
			\RGA\Domain\Model\Transport\Transport::class,
			$events
		);
	}
	
	/**
	 * @return AggregateChanged|Transport
	 */
	private function newTransportCreated()
	{
		return Event\NewTransportCreated::occur($this->uuid->toString(), [
			'activation'  => $this->activation->toString(),
			'shipment_id' => $this->shipmentId->toString(),
			'domains'     => $this->domains->toString(),
			'names'       => $this->names->toString()
		]);
	}
}