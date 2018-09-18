<?php

namespace RGA\Test\Domain\Model\ReturnPackage;

use Ayeo\Price\Price;
use RGA\Domain\Model\ReturnPackage\ReturnPackage as ValueObject;
use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Domain\Model\ReturnPackage\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Domain\Model\AggregateChangedTestCase;

class ReturnPackageTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\Id */
	private $id;
	
	/** @var ValueObject\RgaUuid */
	private $rgaUuid;
	
	/** @var ValueObject\TransportUuid */
	private $transportUuid;
	
	/** @var ValueObject\NettPrice */
	private $nettPrice;
	
	/** @var ValueObject\VatRate */
	private $vatRate;
	
	/** @var ValueObject\Currency */
	private $currency;
	
	protected function setUp()
	{
		$price = Price::buildByGross(10, 23, 'PLN');
		
		$this->id = ValueObject\Id::fromInteger(1);
		$this->rgaUuid = ValueObject\RgaUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->transportUuid = ValueObject\TransportUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->nettPrice = ValueObject\NettPrice::fromFloat($price->getNett());
		$this->vatRate = ValueObject\VatRate::fromInteger($price->getTaxRate());
		$this->currency = ValueObject\Currency::fromString($price->getCurrencySymbol());
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_return_package()
	{
		$returnPackage = ReturnPackage::createNewReturnPackage(
			$this->id,
			$this->rgaUuid,
			$this->transportUuid,
			$this->nettPrice,
			$this->vatRate,
			$this->currency
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($returnPackage);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewReturnPackageCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewReturnPackageCreated::class, $event->messageName());
		$this->assertTrue($this->id->equals($event->returnPackageId()));
		$this->assertTrue($this->rgaUuid->equals($event->returnPackageRgaUuid()));
		$this->assertTrue($this->transportUuid->equals($event->returnPackageTransportUuid()));
		$this->assertTrue($this->nettPrice->equals($event->returnPackageNettPrice()));
		$this->assertTrue($this->vatRate->equals($event->returnPackageVatRate()));
		$this->assertTrue($this->currency->equals($event->returnPackageCurrency()));
	}
	
	/**
	 * @test
	 */
	public function it_sets_return_package()
	{
		$returnPackage = $this->reconstituteReturnPackageFromHistory($this->newReturnPackageCreated());
		
		$packageNo = ValueObject\PackageNo::fromString('123456789');
		$packageSentAt = ValueObject\PackageSentAt::fromString(date('Y-m-d H:i:s'));
		
		$returnPackage->setReturnPackage($packageNo, $packageSentAt);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($returnPackage);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ReturnPackageSet $event */
		$event = $events[0];
		
		$this->assertSame(Event\ReturnPackageSet::class, $event->messageName());
		$this->assertTrue($packageNo->equals($event->returnPackageNo()));
		$this->assertTrue($packageSentAt->equals($event->returnPackageSentAt()));
	}
	
	/**
	 * @param AggregateChanged ...$events
	 * @return object|ReturnPackage
	 */
	private function reconstituteReturnPackageFromHistory(AggregateChanged ...$events)
	{
		return $this->reconstituteAggregateFromHistory(
			\RGA\Domain\Model\ReturnPackage\ReturnPackage::class,
			$events
		);
	}
	
	/**
	 * @return AggregateChanged|ReturnPackage
	 */
	private function newReturnPackageCreated()
	{
		return Event\NewReturnPackageCreated::occur($this->id->toString(), [
			'rga_uuid' => $this->rgaUuid->toString(),
			'transport_uuid' => $this->transportUuid->toString(),
			'nett_price' => $this->nettPrice->toString(),
			'vat_rate' => $this->vatRate->toString(),
			'currency' => $this->currency->toString()
		]);
	}
}