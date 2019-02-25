<?php

namespace RGA\Test\Application\Dictionary\Query;

use RGA\Application\Dictionary\Query\ReadModel\Dictionary;
use RGA\Application\Dictionary\Query\V1;
use RGA\Infrastructure\Query\Dictionary\InMemoryDictionaryQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindOneByUuidHandlerTest
	extends QueryHandlerTestCase
{
	use DictionaryHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_dictionary_by_uuid()
	{
		$uuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		
		// given
		$view1 = $this->createDictionary($uuid, \Ramsey\Uuid\Uuid::uuid4()->toString(), 'reason');
		$view2 = $this->createDictionary(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString(), 'expectation');
		
		// when
		/** @var InMemoryDictionaryQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\DictionaryQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindOneByUuid($uuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var Dictionary $result */
		$result = $query->getView();
		
		$this->assertTrue($result->identifier() === $uuid);
	}
}