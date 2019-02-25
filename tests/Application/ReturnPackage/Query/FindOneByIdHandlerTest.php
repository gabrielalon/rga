<?php

namespace RGA\Test\Application\ReturnPackage\Query;

use RGA\Application\ReturnPackage\Query\ReturnPackage;
use RGA\Application\ReturnPackage\Query\V1;
use RGA\Infrastructure\Query\ReturnPackage\InMemoryReturnPackageQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindOneByIdHandlerTest
	extends QueryHandlerTestCase
{
	use ReturnPackageHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_return_package_by_id()
	{
		$id = 10;
		
		// given
		$view1 = $this->createReturnPackageView($id, \Ramsey\Uuid\Uuid::uuid4()->toString());
		$view2 = $this->createReturnPackageView(2, \Ramsey\Uuid\Uuid::uuid4()->toString());
		
		// when
		/** @var InMemoryReturnPackageQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\ReturnPackageQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindOneById($id);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var ReturnPackage $result */
		$result = $query->getView();
		
		$this->assertTrue($result->identifier() == $id);
	}
}