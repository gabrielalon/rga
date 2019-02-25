<?php

namespace RGA\Test\Application\State\Query;

use RGA\Application\State\Query\V1;
use RGA\Infrastructure\Query\State\InMemoryStateQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllHandlerTest
	extends QueryHandlerTestCase
{
	use StateHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_states()
	{
		// given
		$view1 = $this->createStateView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'test');
		$view2 = $this->createStateView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'test2');
		
		// when
		/** @var InMemoryStateQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\StateQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAll();
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertEquals($query->getViewCollection()->count(), 2);
	}
}