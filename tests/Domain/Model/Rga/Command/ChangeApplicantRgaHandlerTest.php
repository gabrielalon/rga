<?php

namespace RGA\Test\Domain\Model\Rga\Command;

use RGA\Domain\Model\Rga\Command\ChangeApplicantRga;
use RGA\Domain\Model\Rga\Event\ApplicantRgaChanged;
use RGA\Domain\Model\Rga\Projection\RgaProjectorInterface;
use RGA\Domain\Model\Rga\Rga;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Rga\Projection\InMemoryRgaProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class ChangeApplicantRgaHandlerTest
	extends CommandHandlerTestCase
{
	use CreateRgaHandlerTestTrait;
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_applicant_rga()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		/** @var RgaObject $sourceObject */
		$sourceObject = $this->sourceService->buildObject($this->sourceService->orderID);
		/** @var RgaObjectItem $sourceObjectItem */
		$sourceObjectItem = $sourceObject->getItems()->current();
		$command = $this->getCreateCommand($uuid, $sourceObject, $sourceObjectItem);
		$this->getCommandBus()->dispatch($command);
		
		//when
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
		
		$command = new ChangeApplicantRga(
			$uuid->toString(),
			$address,
			$contact,
			$this->bank
		);
		
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryRgaProjector $projector */
		$projector = $this->getFromContainer(RgaProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getApplicantFullName()->toString(), $address->getFullName());
		$this->assertEquals($entity->getApplicantStreetName()->toString(), $address->getStreetName());
		$this->assertEquals($entity->getApplicantBuildingNumber()->toString(), $address->getBuildingNumber());
		$this->assertEquals($entity->getApplicantApartmentNumber()->toString(), $address->getApartmentNumber());
		$this->assertEquals($entity->getApplicantCity()->toString(), $address->getCity());
		$this->assertEquals($entity->getApplicantPostalCode()->toString(), $address->getPostalCode());
		$this->assertEquals($entity->getApplicantCountryCode()->toString(), $address->getCountryCode());
		
		$this->assertEquals($entity->getApplicantFullName()->toString(), $address->getFullName());
		$this->assertEquals($entity->getApplicantEmail()->toString(), $contact->getEmail());
		$this->assertEquals($entity->getApplicantTelephone()->toString(), $contact->getTelephone());
		$this->assertEquals($entity->getApplicantContactPreference()->toString(), $contact->getPreferredForm());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ApplicantRgaChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($entity->getUuid()->toString(), $event->aggregateId());
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
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Rga::class), $uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}