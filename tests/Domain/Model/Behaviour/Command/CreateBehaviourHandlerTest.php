<?php

namespace RGA\Test\Domain\Model\Behaviour\Command;

use RGA\Application\Assert\Exception\AssertionFailedException;
use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Domain\Model\Behaviour\Command\CreateBehaviour;
use RGA\Domain\Model\Behaviour\Enum\Type;
use RGA\Domain\Model\Behaviour\Event\NewBehaviourCreated;
use RGA\Domain\Model\Behaviour\Projection\BehaviourProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Behaviour\Projection\InMemoryBehaviourProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class CreateBehaviourHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_created_new_complaint_behaviour()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$names = ['pl' => 'test', 'en' => 'testowe'];
		$command = new CreateBehaviour($uuid->toString(), Type::COMPLAINT, $names, true);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryBehaviourProjector $projector */
		$projector = $this->getFromContainer(BehaviourProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getType()->toString(), Type::COMPLAINT);
		$this->assertEquals($entity->getNames()->toString(), \json_encode($names));
		$this->assertEquals($entity->getActivation()->toString(), '1');
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewBehaviourCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getUuid()->equals($event->behaviourUuid()));
			$this->assertTrue($entity->getType()->equals($event->behaviourType()));
			$this->assertTrue($entity->getNames()->equals($event->behaviourNames()));
			$this->assertTrue($entity->getActivation()->equals($event->behaviourActivation()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Behaviour::class), $uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 1);
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function cannot_create_behaviour_with_wrong_type()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$names = ['pl' => 'test', 'en' => 'testowe'];
		$command = new CreateBehaviour($uuid->toString(), 'test', $names, true);
		
		//when
		$this->expectException(AssertionFailedException::class);
		$this->getCommandBus()->dispatch($command);
	}
}