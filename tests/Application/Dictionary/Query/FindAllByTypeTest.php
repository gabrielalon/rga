<?php

namespace RGA\Test\Application\Dictionary\Query;

use RGA\Application\Dictionary\Query\ReadModel\Dictionary;
use RGA\Application\Dictionary\Query\ReadModel\DictionaryCollection;
use RGA\Application\Dictionary\Query\V1;
use RGA\Infrastructure\Query\Dictionary\InMemoryDictionaryQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByTypeTest
	extends QueryHandlerTestCase
{
	use DictionaryHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_dictionaries_by_type()
	{
		$type = 'reason';
		
		// given
		$view1 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString(), $type);
		$view2 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString(), 'expectation');
		
		// when
		/** @var InMemoryDictionaryQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\DictionaryQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAllByType($type);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var DictionaryCollection $result */
		$collection = $query->getViewCollection();
		
		/** @var Dictionary $result */
		$result = $collection->current();
		$this->assertTrue($result->type() === $type);
	}
}