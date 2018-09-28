<?php

namespace RGA\Test\Domain\Model\Dictionary\Command;

use RGA\Domain\Model\Dictionary\Command\ChangeDictionary;
use RGA\Domain\Model\Dictionary\Command\CreateDictionary;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\Dictionary\Enum\Type;
use RGA\Domain\Model\Dictionary\Event\ExistingDictionaryChanged;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Dictionary\Projection\InMemoryDictionaryProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

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
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getEntries()->toString(), \serialize($entries));
		$this->assertEquals($entity->getBehaviours()->toString(), \serialize($behaviours));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingDictionaryChanged $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($entity->getUuid()->toString(), $event->aggregateId());
			$this->assertTrue($entity->getEntries()->equals($event->dictionaryValues()));
			$this->assertTrue($entity->getBehaviours()->equals($event->dictionaryBehaviours()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Dictionary::class), $uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}