<?php

namespace RGA\Test\Application\State\Command;

use RGA\Application\State\Command\CreateState;
use RGA\Application\State\Event\NewStateCreated;
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

class CreateStateHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_created_new_complaint_state()
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
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryStateProjector $projector */
		$projector = $this->getFromContainer(StateProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getIdentifier()->toString(), $uuid->toString());
		$this->assertEquals($entity->getColorCode()->toString(), $color);
		$this->assertEquals($entity->getIsEditable()->toString(), '1');
		$this->assertEquals($entity->getIsDeletable()->toString(), '1');
		$this->assertEquals($entity->getIsRejectable()->toString(), '1');
		$this->assertEquals($entity->getIsFinishable()->toString(), '1');
		$this->assertEquals($entity->getIsCloseable()->toString(), '1');
		$this->assertEquals($entity->getIsSendingEmail()->toString(), '1');
		$this->assertEquals($entity->getNames()->toString(), \serialize($names));
		$this->assertEquals($entity->getEmailSubjects()->toString(), \serialize($emailSubjects));
		$this->assertEquals($entity->getEmailBodies()->toString(), \serialize($emailBodies));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewStateCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getIdentifier()->equals($event->stateUuid()));
			$this->assertTrue($entity->getIsEditable()->equals($event->stateIsEditable()));
			$this->assertTrue($entity->getIsDeletable()->equals($event->stateIsDeletable()));
			$this->assertTrue($entity->getIsRejectable()->equals($event->stateIsRejectable()));
			$this->assertTrue($entity->getIsFinishable()->equals($event->stateIsFinishable()));
			$this->assertTrue($entity->getIsCloseable()->equals($event->stateIsCloseable()));
			$this->assertTrue($entity->getIsSendingEmail()->equals($event->stateIsSendingEmail()));
			$this->assertTrue($entity->getColorCode()->equals($event->stateColorCode()));
			$this->assertTrue($entity->getNames()->equals($event->stateNames()));
			$this->assertTrue($entity->getEmailSubjects()->equals($event->stateEmailSubjects()));
			$this->assertTrue($entity->getEmailBodies()->equals($event->stateEmailBodies()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(State::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 1);
	}
}