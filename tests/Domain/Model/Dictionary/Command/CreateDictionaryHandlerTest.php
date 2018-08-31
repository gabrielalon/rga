<?php

namespace RGA\Test\Domain\Model\Dictionary\Command;

use RGA\Application\Assert\Exception\AssertionFailedException;
use RGA\Domain\Model\Dictionary\Command\CreateDictionary;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\Dictionary\Enum\Type;
use RGA\Domain\Model\Dictionary\Event\NewDictionaryCreated;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Test\Domain\Model\CommandHandlerTestCase;
use RGA\Test\Infrastructure\Dictionary\Projection\InMemoryDictionaryProjector;
use RGA\Test\Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository;
use RGA\Test\Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository;

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
		$values = ['pl' => 'test', 'en' => 'testowe'];
		$command = new CreateDictionary($uuid->toString(), Type::CONTACT_PREFERENCE, $values);
		
		//when
		$this->getCommandBus()->dispatch($command);
		
		//then
		/** @var InMemoryDictionaryProjector $projector */
		$projector = $this->getFromContainer(DictionaryProjectorInterface::class);
		$entity = $projector->get($uuid->toString());
		
		$this->assertEquals($entity->getUuid()->toString(), $uuid->toString());
		$this->assertEquals($entity->getType()->toString(), Type::CONTACT_PREFERENCE);
		$this->assertEquals($entity->getValues()->toString(), \json_encode($values));
		
		/** @var InMemoryEventStreamRepository $streamRepository */
		$streamRepository = $this->getFromContainer(EventStreamRepositoryInterface::class);
		$collection = $streamRepository->load($uuid->toString(), 1);
		
		foreach ($collection->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			
			/** @var NewDictionaryCreated $event */
			$event = $event::fromEventStream($eventStream);
			
			$this->assertTrue($entity->getUuid()->equals($event->dictionaryUuid()));
			$this->assertTrue($entity->getType()->equals($event->dictionaryType()));
			$this->assertTrue($entity->getValues()->equals($event->dictionaryValues()));
		}
		
		/** @var InMemorySnapshotRepository $snapshotRepository */
		$snapshotRepository = $this->getFromContainer(SnapshotRepositoryInterface::class);
		$snapshot = $snapshotRepository->get(AggregateType::fromAggregateRootClass(Dictionary::class), $uuid->toString());
		
		$this->assertEquals($snapshot['aggregate_version'], 1);
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function cannot_create_dictionary_with_wrong_type()
	{
		//given
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$vaues = ['pl' => 'test', 'en' => 'testowe'];
		$command = new CreateDictionary($uuid->toString(), 'test', $vaues);
		
		//when
		$this->expectException(AssertionFailedException::class);
		$this->getCommandBus()->dispatch($command);
	}
}