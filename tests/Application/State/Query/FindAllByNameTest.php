<?php

namespace RGA\Test\Application\State\Query;

use RGA\Application\State\Query\ReadModel\State;
use RGA\Application\State\Query\V1;
use RGA\Infrastructure\Query\State\InMemoryStateQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByNameTest
	extends QueryHandlerTestCase
{
	use StateHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_state_by_name()
	{
		$name = 'test';
		
		// given
		$view1 = $this->createStateView(\Ramsey\Uuid\Uuid::uuid4()->toString(), $name);
		$view2 = $this->createStateView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'test2');
		
		// when
		/** @var InMemoryStateQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\StateQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindOneByName([$name]);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var State $result */
		$result = $query->getView();
		
		$this->assertTrue($result->getName('pl') === $name);
	}
}