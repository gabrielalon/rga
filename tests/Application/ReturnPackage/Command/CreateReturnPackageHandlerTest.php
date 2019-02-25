<?php

namespace RGA\Test\Application\ReturnPackage\Command;

use Ayeo\Price\Price;
use RGA\Application\ReturnPackage\Command\CreateReturnPackage;
use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Application\ReturnPackage\Event\NewReturnPackageCreated;
use RGA\Domain\Model\ReturnPackage\Projection\ReturnPackageProjectorInterface;
use RGA\Infrastructure\Projection\ReturnPackage\InMemoryReturnPackageProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class CreateReturnPackageHandlerTest
	extends CommandHandlerTestCase
{
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_creates_new_return_package()
	{
		//given
		$rgaUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		$transportUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		$price = Price::buildByGross(10, 23, 'PLN');
		$command = new CreateReturnPackage(1, $rgaUuid, $transportUuid, $price);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryReturnPackageProjector $projector */
		$projector = $this->getFromContainer(ReturnPackageProjectorInterface::class);
		$entity = $projector->get($command->getId());
		
		$this->assertEquals($entity->getIdentifier()->toString(), $command->getId());
		$this->assertEquals($entity->getRgaUuid()->toString(), $command->getRgaUuid());
		$this->assertEquals($entity->getTransportUuid()->toString(), $command->getTransportUuid());
		$this->assertEquals($entity->getNettPrice()->toString(), $command->getPrice()->getNett());
		$this->assertEquals($entity->getVatRate()->toString(), $command->getPrice()->getTaxRate());
		$this->assertEquals($entity->getCurrency()->toString(), $command->getPrice()->getCurrencySymbol());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($command->getId(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewReturnPackageCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getIdentifier()->equals($event->returnPackageId()));
			$this->assertTrue($entity->getRgaUuid()->equals($event->returnPackageRgaUuid()));
			$this->assertTrue($entity->getTransportUuid()->equals($event->returnPackageTransportUuid()));
			$this->assertTrue($entity->getNettPrice()->equals($event->returnPackageNettPrice()));
			$this->assertTrue($entity->getVatRate()->equals($event->returnPackageVatRate()));
			$this->assertTrue($entity->getCurrency()->equals($event->returnPackageCurrency()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(ReturnPackage::class), $command->getId());
		
		$this->assertEquals($snapshot->getVersion(), 1);
	}
}