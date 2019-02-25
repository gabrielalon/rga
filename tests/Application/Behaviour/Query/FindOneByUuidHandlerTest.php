<?php

namespace RGA\Test\Application\Behaviour\Query;

use RGA\Application\Behaviour\Query\ReadModel\Behaviour;
use RGA\Application\Behaviour\Query\V1;
use RGA\Infrastructure\Query\Behaviour\InMemoryBehaviourQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindOneByUuidHandlerTest
	extends QueryHandlerTestCase
{
	use BehaviourHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_behaviour_by_uuid()
	{
		$uuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		
		// given
		$view1 = $this->createBehaviourView($uuid, 'return');
		$view2 = $this->createBehaviourView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'complaint');
		
		// when
		/** @var InMemoryBehaviourQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\BehaviourQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindOneByUuid($uuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var Behaviour $result */
		$result = $query->getView();
		
		$this->assertTrue($result->identifier() === $uuid);
	}
}