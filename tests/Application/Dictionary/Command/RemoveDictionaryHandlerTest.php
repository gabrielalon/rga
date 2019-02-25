<?php

namespace RGA\Test\Application\Dictionary\Command;

use RGA\Application\Dictionary\Command\CreateDictionary;
use RGA\Application\Dictionary\Command\RemoveDictionary;
use RGA\Application\Dictionary\Enum\Type;
use RGA\Application\Dictionary\Event\ExistingDictionaryRemoved;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Infrastructure\Projection\Dictionary\InMemoryDictionaryProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class RemoveDictionaryHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_removes_existing_dictionary()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$values = ['pl' => 'test', 'en' => 'testowe'];
		$behaviours = [\Ramsey\Uuid\Uuid::uuid4()->toString()];
		
		$command = new CreateDictionary($uuid->toString(), Type::CONTACT_PREFERENCE, $values, $behaviours);
		$this->getCommandBus()->dispatch($command);
		
		//when
		$command = new RemoveDictionary($uuid->toString());
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryDictionaryProjector $projector */
		$projector = $this->getFromContainer(DictionaryProjectorInterface::class);
		$this->expectException(\RuntimeException::class);
		$projector->get($uuid->toString());
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 2);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var ExistingDictionaryRemoved $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertEquals($uuid->toString(), $event->aggregateId());
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Dictionary::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 2);
	}
}