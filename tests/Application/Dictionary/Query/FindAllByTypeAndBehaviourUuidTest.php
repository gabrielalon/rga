<?php

namespace RGA\Test\Application\Dictionary\Query;

use RGA\Application\Dictionary\Query\ReadModel\Dictionary;
use RGA\Application\Dictionary\Query\V1;
use RGA\Infrastructure\Query\Dictionary\InMemoryDictionaryQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByTypeAndBehaviourUuidTest
	extends QueryHandlerTestCase
{
	use DictionaryHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_dictionaries_by_behaviour_uuid_and_type()
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		$type = 'expectation';
		
		// given
		$view1 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), $uuid, $type);
		$view2 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString(), 'expectation');
		
		// when
		/** @var InMemoryDictionaryQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\DictionaryQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAllByTypeAndBehaviourUuid($type, $uuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var Dictionary $result */
		$result = $query->getViewCollection()->current();
		
		$this->assertTrue(\in_array($uuid, $result->behaviours()));
		$this->assertTrue($result->type() === $type);
	}
}