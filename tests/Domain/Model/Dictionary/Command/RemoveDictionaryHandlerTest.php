<?php

namespace RGA\Test\Domain\Model\Dictionary\Command;

use RGA\Domain\Model\Dictionary\Command\CreateDictionary;
use RGA\Domain\Model\Dictionary\Command\RemoveDictionary;
use RGA\Domain\Model\Dictionary\Enum\Type;
use RGA\Domain\Model\Dictionary\Event\ExistingDictionaryRemoved;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Dictionary\Projection\InMemoryDictionaryProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

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
		
		$command = new CreateDictionary($uuid->toString(), Type::CONTACT_PREFERENCE, $values);
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
		$snapshot = $snapshotRepository->get($uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 2);
	}
}