<?php

namespace RGA\Test\Application\Transport\Query;

use RGA\Application\Transport\Query\V1;
use RGA\Infrastructure\Query\Transport\InMemoryTransportQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllHandlerTest
	extends QueryHandlerTestCase
{
	use TransportHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_transports()
	{
		// given
		$view1 = $this->createTransportView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'test');
		$view2 = $this->createTransportView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'test2');
		
		// when
		/** @var InMemoryTransportQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\TransportQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAll();
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertEquals($query->getViewCollection()->count(), 2);
	}
}