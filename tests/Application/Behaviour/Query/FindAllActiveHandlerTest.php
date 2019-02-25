<?php

namespace RGA\Test\Application\Behaviour\Query;

use RGA\Application\Behaviour\Query\V1;
use RGA\Infrastructure\Query\Behaviour\InMemoryBehaviourQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllActiveHandlerTest
	extends QueryHandlerTestCase
{
	use BehaviourHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_active_behaviours()
	{
		// given
		$view1 = $this->createBehaviourView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'return');
		$view2 = $this->createBehaviourView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'complaint');
		
		// when
		/** @var InMemoryBehaviourQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\BehaviourQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAllActive();
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertEquals($query->getViewCollection()->count(), 2);
	}
}