<?php

namespace RGA\Test\Application\Dictionary\Command;

use RGA\Application\Dictionary\Command\ChangeDictionary;
use RGA\Application\Dictionary\Command\CreateDictionary;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Application\Dictionary\Enum\Type;
use RGA\Application\Dictionary\Event\ExistingDictionaryChanged;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Infrastructure\Projection\Dictionary\InMemoryDictionaryProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class ChangeDictionaryHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_changes_existing_contact_preference_dictionary()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$entries = ['pl' => 'test', 'en' => 'testowe'];
		$behaviours = [\Ramsey\Uuid\Uuid::uuid4()->toString()];
		
		$command = new CreateDictionary($uuid->toString(), Type::CONTACT_PREFERENCE, $entries, $behaviours);
		$this->getCommandBus()->dispatch($command);
		
		$entries = ['pl' => 'testowo', 'en' => 'test'];
		$behaviours = [\Ramsey\Uuid\Uuid::uuid4()->toString()];
		$command = new ChangeDictionary($uuid->toString(), $entries, $behaviours);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryDictionaryProjector $projector */
		$projector = $this->getFromContainer(DictionaryProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getIdentifier()->toString(), $uuid->toString());
		$this->assertEquals($entity->getEntries()->raw(), $entries);
		$this->assertEquals($entity->getBehaviours()->raw(), $behaviours);
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingDictionaryChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($entity->getIdentifier()->toString(), $event->aggregateId());
			$this->assertTrue($entity->getEntries()->equals($event->dictionaryValues()));
			$this->assertTrue($entity->getBehaviours()->equals($event->dictionaryBehaviours()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Dictionary::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 2);
	}
}