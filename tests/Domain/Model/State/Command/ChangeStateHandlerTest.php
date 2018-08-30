<?php

namespace RGA\Test\Domain\Model\Dictionary\Command;

use RGA\Domain\Model\State\Command\ChangeState;
use RGA\Domain\Model\State\Command\CreateState;
use RGA\Domain\Model\State\Event\ExistingStateChanged;
use RGA\Domain\Model\State\Projection\StateProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\State\Projection\InMemoryStateProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

class ChangeStateHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_existing_complaint_state()
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
		$names = ['pl' => 'Nazwa test', 'en' => 'Name test'];
		$emailSubjects = ['pl' => 'Temat test', 'en' => 'Subject test'];
		$emailBodies = ['pl' => 'Treść test', 'en' => 'Body test'];
		$color = '#009900';
		$command = new ChangeState(
			$uuid->toString(),
			false,
			false,
			false,
			false,
			false,
			false,
			$color,
			$names,
			$emailSubjects,
			$emailBodies
		);
		
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryStateProjector $projector */
		$projector = $this->getFromContainer(StateProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getColorCode()->toString(), $color);
		$this->assertEquals($entity->isEditable()->toString(), '0');
		$this->assertEquals($entity->isDeletable()->toString(), '0');
		$this->assertEquals($entity->isRejectable()->toString(), '0');
		$this->assertEquals($entity->isFinishable()->toString(), '0');
		$this->assertEquals($entity->isCloseable()->toString(), '0');
		$this->assertEquals($entity->isSendingEmail()->toString(), '0');
		$this->assertEquals($entity->getNames()->toString(), \json_encode($names));
		$this->assertEquals($entity->getEmailSubjects()->toString(), \json_encode($emailSubjects));
		$this->assertEquals($entity->getEmailBodies()->toString(), \json_encode($emailBodies));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingStateChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($entity->getUuid()->toString(), $event->aggregateId());
			$this->assertTrue($entity->isEditable()->equals($event->stateIsEditable()));
			$this->assertTrue($entity->isDeletable()->equals($event->stateIsDeletable()));
			$this->assertTrue($entity->isRejectable()->equals($event->stateIsRejectable()));
			$this->assertTrue($entity->isFinishable()->equals($event->stateIsFinishable()));
			$this->assertTrue($entity->isCloseable()->equals($event->stateIsCloseable()));
			$this->assertTrue($entity->isSendingEmail()->equals($event->stateIsSendingEmail()));
			$this->assertTrue($entity->getColorCode()->equals($event->stateColorCode()));
			$this->assertTrue($entity->getNames()->equals($event->stateNames()));
			$this->assertTrue($entity->getEmailSubjects()->equals($event->stateEmailSubjects()));
			$this->assertTrue($entity->getEmailBodies()->equals($event->stateEmailBodies()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}