<?php

namespace RGA\Test\Application\Dictionary\Command;

use RGA\Application\Assert\Exception\AssertionFailedException;
use RGA\Application\Dictionary\Command\CreateDictionary;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Application\Dictionary\Enum\Type;
use RGA\Application\Dictionary\Event\NewDictionaryCreated;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Infrastructure\Projection\Dictionary\InMemoryDictionaryProjector;
use RGA\Infrastructure\Query\EventStream\InMemoryEventStreamRepository;
use RGA\Infrastructure\Query\Snapshot\InMemorySnapshotRepository;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Application\CommandHandlerTestCase;

class CreateDictionaryHandlerTest
	extends CommandHandlerTestCase
{
	/**
	 * @test
	 * @throws \Exception
	 */
	public function it_creates_new_contact_preference_dictionary()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$entries = ['pl' => 'test', 'en' => 'testowe'];
		$behaviours = [\Ramsey\Uuid\Uuid::uuid4()->toString()];
		$command = new CreateDictionary($uuid->toString(), Type::CONTACT_PREFERENCE, $entries, $behaviours);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryDictionaryProjector $projector */
		$projector = $this->getFromContainer(DictionaryProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getIdentifier()->toString(), $uuid->toString());
		$this->assertEquals($entity->getType()->toString(), Type::CONTACT_PREFERENCE);
		$this->assertEquals($entity->getEntries()->toString(), \serialize($entries));
		$this->assertEquals($entity->getBehaviours()->toString(), \serialize($behaviours));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewDictionaryCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getIdentifier()->equals($event->dictionaryUuid()));
			$this->assertTrue($entity->getType()->equals($event->dictionaryType()));
			$this->assertTrue($entity->getEntries()->equals($event->dictionaryValues()));
			$this->assertTrue($entity->getBehaviours()->equals($event->dictionaryBehaviours()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Dictionary::class), $uuid->toString());
		
		$this->assertEquals($snapshot->getVersion(), 1);
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function cannot_create_dictionary_with_wrong_type()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		$vaues = ['pl' => 'test', 'en' => 'testowe'];
		$behaviours = [\Ramsey\Uuid\Uuid::uuid4()->toString()];
		$command = new CreateDictionary($uuid, 'test', $vaues, $behaviours);
		
		//when
		$this->expectException(AssertionFailedException::class);
		$this->getCommandBus()->dispatch($command);
	}
}