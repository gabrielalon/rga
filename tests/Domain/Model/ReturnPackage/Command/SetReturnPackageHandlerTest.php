<?php

namespace RGA\Test\Domain\Model\ReturnPackage\Command;

use Ayeo\Price\Price;
use RGA\Domain\Model\ReturnPackage\Command\CreateReturnPackage;
use RGA\Domain\Model\ReturnPackage\Command\SetReturnPackage;
use RGA\Domain\Model\ReturnPackage\Event\ReturnPackageSet;
use RGA\Domain\Model\ReturnPackage\Projection\ReturnPackageProjectorInterface;
use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\ReturnPackage\Projection\InMemoryReturnPackageProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class SetReturnPackageHandlerTest
	extends CommandHandlerTestCase
{
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_sets_package_rga()
	{
		//given
		$id = 1;
		$rgaUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		$transportUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		$price = Price::buildByGross(10, 23, 'PLN');
		$command = new CreateReturnPackage($id, $rgaUuid, $transportUuid, $price);
		$this->getCommandBus()->dispatch($command);
		
		//when
		$command = new SetReturnPackage(
			$id,
			'9999',
			'2018-08-30 12:12:12'
		);
		
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryReturnPackageProjector $projector */
		$projector = $this->getFromContainer(ReturnPackageProjectorInterface::class);
		$entity = $projector->get($id);
		
		$this->assertEquals($entity->getPackageNo()->toString(), $command->getPackageNo());
		$this->assertEquals($entity->getPackageSentAt()->toString(), $command->getSentAt());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($id, 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ReturnPackageSet $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($event->returnPackageNo()->toString(), $command->getPackageNo());
			$this->assertEquals($event->returnPackageSentAt()->toString(), $command->getSentAt());
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(ReturnPackage::class), $id);
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}