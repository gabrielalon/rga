<?php

namespace RGA\Test\Application\State\Command;

use RGA\Application\State\Command\CreateState;
use RGA\Application\State\Command\RemoveState;
use RGA\Application\State\Event\ExistingStateRemoved;
use RGA\Domain\Model\State\Projection\StateProjectorInterface;
use RGA\Domain\Model\State\State;
use RGA\Infrastructure\Projection\State\InMemoryStateProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class RemoveStateHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_removes_existing_state()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$names = ['pl' => 'Nazwa', 'en' => 'Name'];
		$emailSubjects = ['pl' => 'Temat', 'en' => 'Subject'];
		$emailBodies = ['pl' => 'Treść', 'en' => 'Body'];
		$color = '#009911';
		
		$command = new CreateState(
			$uuid->toString(),
			true,
			true,
			true,
			true,
			true,
			true,
			$color,
			$names,
			$emailSubjects,
			$emailBodies
		);
		$this->getCommandBus()->dispatch($command);
		
		//when
		$command = new RemoveState($uuid->toString());
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryStateProjector $projector */
		$projector = $this->getFromContainer(StateProjectorInterface::class);
		$this->expectException(\RuntimeException::class);
		$projector->get($uuid->toString());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingStateRemoved $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($uuid->toString(), $event->aggregateId());
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(State::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 2);
	}
}