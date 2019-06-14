<?php

namespace RGA\Test\Application\Rga;

use Ramsey\Uuid\Uuid;
use RGA\Application\Rga\Integration\Warranty\Calculator;
use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Application\Rga\Event;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Test\Application\AggregateChangedTestCase;
use RGA\Test\Mock\Source\OrderSourceService;

class RgaTest
	extends AggregateChangedTestCase
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\BehaviourUuid */
	private $behaviourUuid;
	
	/** @var ValueObject\StateUuid */
	private $stateUuid;
	
	/** @var ValueObject\TransportUuid */
	private $transportUuid;
	
	/** @var OrderSourceService */
	private $sourceService;
	
	/** @var Calculator */
	private $warrantyCalculator;
	
	/** @var Rga\Applicant\Bank */
	private $bank;
	
	protected function setUp()
	{
		$this->uuid = ValueObject\Uuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		
		$this->stateUuid = ValueObject\StateUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->behaviourUuid = ValueObject\BehaviourUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->transportUuid = ValueObject\TransportUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		
		$this->sourceService = new OrderSourceService();
		$this->warrantyCalculator = $this->getFromContainer(Calculator::class);
		
		$this->bank = (new Rga\Applicant\Bank('ing', '00 0000 0000 0000 0000'));
	}
	
	/**
	 * @test
	 */
	public function it_creates_new_rga()
	{
		/** @var RgaObject $sourceObject */
		$sourceObject = $this->sourceService->buildObject($this->sourceService->orderID);
		/** @var RgaObjectItem $sourceObjectItem */
		$sourceObjectItem = $sourceObject->getItems()->current();

		$rga = Rga::createNewRga(
			$this->uuid,
			new Rga\Reference\References($this->stateUuid->toString(), $this->behaviourUuid->toString(), 'return', $this->transportUuid->toString()),
			new Rga\Given\Item(
			    $sourceObjectItem->getId(),
                $sourceObjectItem->getSourceItemQuantity(),
                $sourceObject->getId(),
                $sourceObjectItem->getName(),
                'reason',
                'expectation',
                'incident'
            ),
			$sourceObject->getApplicant(),
			$sourceObject->getAddress(),
			$sourceObject->getContact(),
			$this->bank,
			$sourceObject,
			$this->warrantyCalculator
		);


		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NewRgaCreated $event */
		$event = $events[0];
		
		$this->assertSame(Event\NewRgaCreated::class, $event->messageName());
		$this->assertTrue($this->uuid->equals($event->rgaUuid()));
		
		$this->assertTrue($this->stateUuid->equals($event->rgaStateUuid()));
		$this->assertTrue($this->behaviourUuid->equals($event->rgaBehaviourUuid()));
		$this->assertTrue($this->transportUuid->equals($event->rgaTransportUuid()));
		
		$this->assertEquals($event->rgaApplicantBankName()->toString(), $this->bank->getName());
		$this->assertEquals($event->rgaApplicantBankAccountNumber()->toString(), $this->bank->getAccountNumber());
		
		$this->assertEquals($event->rgaApplicantObjectId()->toString(), $sourceObject->getApplicant()->getId());
		$this->assertEquals($event->rgaApplicantObjectType()->toString(), $sourceObject->getApplicant()->getType());
		
		$this->assertEquals($event->rgaApplicantFullName()->toString(), $sourceObject->getAddress()->getFullName());
		$this->assertEquals($event->rgaApplicantStreetName()->toString(), $sourceObject->getAddress()->getStreetName());
		$this->assertEquals($event->rgaApplicantBuildingNumber()->toString(), $sourceObject->getAddress()->getBuildingNumber());
		$this->assertEquals($event->rgaApplicantApartmentNumber()->toString(), $sourceObject->getAddress()->getApartmentNumber());
		$this->assertEquals($event->rgaApplicantCity()->toString(), $sourceObject->getAddress()->getCity());
		$this->assertEquals($event->rgaApplicantPostalCode()->toString(), $sourceObject->getAddress()->getPostalCode());
		$this->assertEquals($event->rgaApplicantCountryCode()->toString(), $sourceObject->getAddress()->getCountryCode());
		
		$this->assertEquals($event->rgaApplicantFullName()->toString(), $sourceObject->getAddress()->getFullName());
		$this->assertEquals($event->rgaApplicantEmail()->toString(), $sourceObject->getContact()->getEmail());
		$this->assertEquals($event->rgaApplicantTelephone()->toString(), $sourceObject->getContact()->getTelephone());
		$this->assertEquals($event->rgaApplicantContactPreference()->toString(), $sourceObject->getContact()->getPreferredForm());
		
		$this->assertEquals($event->rgaSourceObjectType()->toString(), $sourceObject->getType());
		$this->assertEquals($event->rgaSourceObjectItemId()->toString(), $sourceObjectItem->getId());
		$this->assertEquals($event->rgaSourceObjectItemQuantity()->toString(), $sourceObjectItem->getSourceItemQuantity());
		$this->assertEquals($event->rgaSourceDateOfCreation()->toString(), date('Y-m-d H:i:s', $sourceObject->getCreatedAt()));
		
		$this->assertEquals($event->rgaProductName()->toString(), $sourceObjectItem->getName());
		$this->assertEquals($event->rgaProductVariantId()->toString(), $sourceObjectItem->getVariantId());
		
		$this->assertEquals($event->rgaApplicantGivenSourceObjectId()->toString(), $sourceObject->getId());
		$this->assertEquals($event->rgaApplicantGivenSourceIdentification()->toString(), $sourceObject->getId());
		$this->assertEquals($event->rgaApplicantGivenProductName()->toString(), $sourceObjectItem->getName());
		
		$this->assertEquals($event->rgaApplicantReasons()->toString(), 'reason');
		$this->assertEquals($event->rgaApplicantExpectations()->toString(), 'expectation');
		$this->assertEquals($event->rgaApplicantDescriptionOfIncident()->toString(), 'incident');
	}
	
	/**
	 * @test
	 */
	public function it_changes_flags_rga()
	{
		$rga = $this->reconstituteRgaFromHistory($this->newRgaCreated());
		
		$rga->flagsRgaChanged(
			Rga\AdminNotesForApplicant::fromString('test'),
			Rga\IsProductReceived::fromBoolean(true),
			Rga\IsCashReturned::fromBoolean(true),
			Rga\IsProductReturned::fromBoolean(true)
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\FlagsRgaChanged $event */
		$event = $events[0];
		
		$this->assertEquals($event->rgaIsProductReceived()->toString(), '1');
		$this->assertEquals($event->rgaIsCashReturned()->toString(), '1');
		$this->assertEquals($event->rgaIsProductReturned()->toString(), '1');
		$this->assertEquals($event->rgaAdminNotesForApplicant()->toString(), 'test');
	}
	
	/**
	 * @test
	 */
	public function it_removes_rga()
	{
		$rga = $this->reconstituteRgaFromHistory($this->newRgaCreated());
		
		$rga->removeRga();
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ExistingRgaRemoved $event */
		$event = $events[0];
		
		$this->assertEquals($event->rgaIsDeleted()->toString(), '1');
	}
	
	/**
	 * @test
	 */
	public function it_sets_package_rga()
	{
		$rga = $this->reconstituteRgaFromHistory($this->newRgaCreated());
		
		$rga->setPackageRga(
			Rga\PackageNo::fromString('999999'),
			Rga\PackageSentAt::fromString('2018-08-30 12:12:12')
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\PackageRgaSet $event */
		$event = $events[0];
		
		$this->assertEquals($event->rgaPackageNo()->toString(), '999999');
		$this->assertEquals($event->rgaPackageSentAt()->toString(), '2018-08-30 12:12:12');
	}
	
	/**
	 * @test
	 */
	public function it_changes_state_rga()
	{
		$rga = $this->reconstituteRgaFromHistory($this->newRgaCreated());
		
		$uuid = Uuid::uuid4()->toString();
		$rga->stateRgaChanged(Rga\StateUuid::fromString($uuid));
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\StateRgaChanged $event */
		$event = $events[0];
		
		$this->assertEquals($event->rgaStateUuid()->toString(), $uuid);
	}
	
	/**
	 * @test
	 */
	public function it_changes_note_rga()
	{
		$rga = $this->reconstituteRgaFromHistory($this->newRgaCreated());
		
		$rga->noteRgaChanged(Rga\AdminNotes::fromString('test'));
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\NoteRgaChanged $event */
		$event = $events[0];
		
		$this->assertEquals($event->rgaAdminNotes()->toString(), 'test');
	}
	
	/**
	 * @test
	 */
	public function it_changes_applicant_rga()
	{
		$rga = $this->reconstituteRgaFromHistory($this->newRgaCreated());
		
		$address = new Rga\Applicant\Address(
			'test testowy',
			'testtest',
			'40',
			'12',
			'12-123',
			'testowa',
			'pl'
		);
		
		$contact = new Rga\Applicant\Contact(
			'testowo@com.pl',
			'000000000',
			'phone'
		);
		
		$rga->applicantRgaChanged(
			$address,
			$contact,
			$this->bank
		);
		
		/** @var AggregateChanged[] $events */
		$events = $this->popRecordedEvents($rga);
		
		$this->assertCount(1, $events);
		
		/** @var Event\ApplicantRgaChanged $event */
		$event = $events[0];
		
		$this->assertEquals($event->rgaApplicantFullName()->toString(), $address->getFullName());
		$this->assertEquals($event->rgaApplicantStreetName()->toString(), $address->getStreetName());
		$this->assertEquals($event->rgaApplicantBuildingNumber()->toString(), $address->getBuildingNumber());
		$this->assertEquals($event->rgaApplicantApartmentNumber()->toString(), $address->getApartmentNumber());
		$this->assertEquals($event->rgaApplicantCity()->toString(), $address->getCity());
		$this->assertEquals($event->rgaApplicantPostalCode()->toString(), $address->getPostalCode());
		$this->assertEquals($event->rgaApplicantCountryCode()->toString(), $address->getCountryCode());
		
		$this->assertEquals($event->rgaApplicantFullName()->toString(), $address->getFullName());
		$this->assertEquals($event->rgaApplicantEmail()->toString(), $contact->getEmail());
		$this->assertEquals($event->rgaApplicantTelephone()->toString(), $contact->getTelephone());
		$this->assertEquals($event->rgaApplicantContactPreference()->toString(), $contact->getPreferredForm());
	}
	
	/**
	 * @param AggregateChanged ...$events
	 * @return object|Rga
	 */
	private function reconstituteRgaFromHistory(AggregateChanged ...$events)
	{
		return $this->reconstituteAggregateFromHistory(
			\RGA\Domain\Model\Rga\Rga::class,
			$events
		);
	}
	
	/**
	 * @return AggregateChanged|Rga
	 */
	private function newRgaCreated()
	{
		/** @var RgaObject $sourceObject */
		$sourceObject = $this->sourceService->buildObject($this->sourceService->orderID);
		/** @var RgaObjectItem $sourceObjectItem */
		$sourceObjectItem = $sourceObject->getItems()->current();
		
		return Event\NewRgaCreated::occur($this->uuid->toString(), [
			'created_at' => \date('Y-m-d H:i:s'),
			
			'behaviour_uuid' => $this->behaviourUuid->toString(),
			'state_uuid'     => $this->stateUuid->toString(),
			'transport_uuid' => $this->transportUuid->toString(),
			
			'source_object_type'      => $sourceObject->getType(),
			'source_object_id'        => $sourceObject->getId(),
			'source_object_item_id'   => $sourceObjectItem->getId(),
            'source_object_item_quantity'   => $sourceObjectItem->getSourceItemQuantity(),
			'source_date_of_creation' => \date('Y-m-d H:i:s', $sourceObject->getCreatedAt()),
			
			'product_name'       => $sourceObjectItem->getName(),
			'product_variant_id' => $sourceObjectItem->getVariantId(),
			
			'applicant_given_source_object_id'      => $sourceObject->getId(),
			'applicant_given_source_identification' => $sourceObject->getId(),
			'applicant_given_product_name'          => $sourceObjectItem->getName(),
			
			'applicant_reasons'                 => 'reason',
			'applicant_expectations'            => 'expectation',
			'applicant_description_of_incident' => 'incident',
			
			'applicant_object_type' => $sourceObject->getApplicant()->getType(),
			'applicant_object_id'   => $sourceObject->getApplicant()->getId(),
			
			'applicant_contact_preference' => $sourceObject->getContact()->getPreferredForm(),
			'applicant_email'              => $sourceObject->getContact()->getEmail(),
			'applicant_telephone'          => $sourceObject->getContact()->getTelephone(),
			
			'applicant_full_name'        => $sourceObject->getAddress()->getFullName(),
			'applicant_street_name'      => $sourceObject->getAddress()->getStreetName(),
			'applicant_building_number'  => $sourceObject->getAddress()->getBuildingNumber(),
			'applicant_apartment_number' => $sourceObject->getAddress()->getApartmentNumber(),
			'applicant_postal_code'      => $sourceObject->getAddress()->getPostalCode(),
			'applicant_city'             => $sourceObject->getAddress()->getCity(),
			'applicant_country_code'     => $sourceObject->getAddress()->getCountryCode(),
			
			'applicant_bank_account_number' => $this->bank->getAccountNumber(),
			'applicant_bank_name'           => $this->bank->getName(),
			
			'admin_notes'               => '',
			'admin_notes_for_applicant' => '',
			
			'is_product_received' => '0',
			'is_cash_returned'    => '0',
			'is_product_returned' => '0',
			'is_deleted'          => '0',
			
			'package_sent'    => '0',
			'package_no'      => '',
			'package_sent_at' => ''
		]);
	}
}