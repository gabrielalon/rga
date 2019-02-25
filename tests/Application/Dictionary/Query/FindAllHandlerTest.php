<?php

namespace RGA\Test\Application\Dictionary\Query;

use RGA\Application\Dictionary\Query\V1;
use RGA\Infrastructure\Query\Dictionary\InMemoryDictionaryQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllHandlerTest
	extends QueryHandlerTestCase
{
	use DictionaryHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_dictionaries()
	{
		// given
		$view1 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString(), 'reason');
		$view2 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString(), 'expectation');
		
		// when
		/** @var InMemoryDictionaryQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\DictionaryQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAll();
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertEquals($query->getViewCollection()->count(), 2);
	}
}