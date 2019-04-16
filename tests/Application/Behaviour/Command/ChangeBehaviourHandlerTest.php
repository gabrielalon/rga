<?php

namespace RGA\Test\Application\Behaviour\Command;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Application\Behaviour\Command\ChangeBehaviour;
use RGA\Application\Behaviour\Command\CreateBehaviour;
use RGA\Application\Behaviour\Enum\Type;
use RGA\Application\Behaviour\Event\ExistingBehaviourChanged;
use RGA\Domain\Model\Behaviour\Projection\BehaviourProjectorInterface;
use RGA\Infrastructure\Projection\Behaviour\InMemoryBehaviourProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class ChangeBehaviourHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_existing_complaint_behaviour()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$names = ['pl' => 'test', 'en' => 'testowe'];
		
		$command = new CreateBehaviour($uuid->toString(), Type::COMPLAINT, $names, true);
		$this->getCommandBus()->dispatch($command);
		
		$names = ['pl' => 'testowo', 'en' => 'test'];
		$command = new ChangeBehaviour($uuid->toString(), $names, false);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryBehaviourProjector $projector */
		$projector = $this->getFromContainer(BehaviourProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getIdentifier()->toString(), $uuid->toString());
		$this->assertEquals($entity->getNames()->toString(), \serialize($names));
		$this->assertEquals($entity->getActive()->toString(), '0');
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingBehaviourChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($entity->getIdentifier()->toString(), $event->aggregateId());
			$this->assertTrue($entity->getNames()->equals($event->behaviourNames()));
			$this->assertTrue($entity->getActive()->equals($event->behaviourActivation()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Behaviour::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 2);
	}
}