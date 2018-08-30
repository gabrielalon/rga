<?php

namespace RGA\Test\Domain\Model\Rga\Command;

use RGA\Domain\Model\Rga\Command\CreateRga;
use RGA\Domain\Model\Rga\Event\NewRgaCreated;
use RGA\Domain\Model\Rga\Projection\RgaProjectorInterface;
use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Rga\Projection\InMemoryRgaProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class CreateRgaHandlerTest
	extends CommandHandlerTestCase
{
	use CreateRgaHandlerTestTrait;
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_created_new_rga()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		/** @var RgaObject $sourceObject */
		$sourceObject = $this->sourceService->buildObject($this->sourceService->orderID);
		/** @var RgaObjectItem $sourceObjectItem */
		$sourceObjectItem = $sourceObject->getItems()->current();
		$command = $this->getCreateCommand($uuid, $sourceObject, $sourceObjectItem);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryRgaProjector $projector */
		$projector = $this->getFromContainer(RgaProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertTrue($this->stateUuid->equals($entity->getStateUuid()));
		$this->assertTrue($this->behaviourUuid->equals($entity->getBehaviourUuid()));
		$this->assertTrue($this->transportUuid->equals($entity->getTransportUuid()));
		
		$this->assertEquals($entity->getApplicantBankName()->toString(), $this->bank->getName());
		$this->assertEquals($entity->getApplicantBankAccountNumber()->toString(), $this->bank->getAccountNumber());
		
		$this->assertEquals($entity->getApplicantObjectId()->toString(), $sourceObject->getApplicant()->getId());
		$this->assertEquals($entity->getApplicantObjectType()->toString(), $sourceObject->getApplicant()->getType());
		
		$this->assertEquals($entity->getApplicantFullName()->toString(), $sourceObject->getAddress()->getFullName());
		$this->assertEquals($entity->getApplicantStreetName()->toString(), $sourceObject->getAddress()->getStreetName());
		$this->assertEquals($entity->getApplicantBuildingNumber()->toString(), $sourceObject->getAddress()->getBuildingNumber());
		$this->assertEquals($entity->getApplicantApartmentNumber()->toString(), $sourceObject->getAddress()->getApartmentNumber());
		$this->assertEquals($entity->getApplicantCity()->toString(), $sourceObject->getAddress()->getCity());
		$this->assertEquals($entity->getApplicantPostalCode()->toString(), $sourceObject->getAddress()->getPostalCode());
		$this->assertEquals($entity->getApplicantCountryCode()->toString(), $sourceObject->getAddress()->getCountryCode());
		
		$this->assertEquals($entity->getApplicantFullName()->toString(), $sourceObject->getAddress()->getFullName());
		$this->assertEquals($entity->getApplicantEmail()->toString(), $sourceObject->getContact()->getEmail());
		$this->assertEquals($entity->getApplicantTelephone()->toString(), $sourceObject->getContact()->getTelephone());
		$this->assertEquals($entity->getApplicantContactPreference()->toString(), $sourceObject->getContact()->getPreferredForm());
		
		$this->assertEquals($entity->getSourceObjectType()->toString(), $sourceObject->getType());
		$this->assertEquals($entity->getSourceObjectItemId()->toString(), $sourceObjectItem->getId());
		$this->assertEquals($entity->getSourceDateOfCreation()->toString(), date('Y-m-d H:i:s', $sourceObject->getCreatedAt()));
		
		$this->assertEquals($entity->getProductName()->toString(), $sourceObjectItem->getName());
		$this->assertEquals($entity->getProductVariantId()->toString(), $sourceObjectItem->getVariantId());
		
		$this->assertEquals($entity->getApplicantGivenSourceObjectId()->toString(), $sourceObject->getId());
		$this->assertEquals($entity->getApplicantGivenSourceIdentification()->toString(), $sourceObject->getId());
		$this->assertEquals($entity->getApplicantGivenProductName()->toString(), $sourceObjectItem->getName());
		
		$this->assertEquals($entity->getApplicantReasons()->toString(), 'reason');
		$this->assertEquals($entity->getApplicantExpectations()->toString(), 'expectation');
		$this->assertEquals($entity->getApplicantDescriptionOfIncident()->toString(), 'incident');
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewRgaCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getUuid()->equals($entity->getUuid()));
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
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 1);
	}
}