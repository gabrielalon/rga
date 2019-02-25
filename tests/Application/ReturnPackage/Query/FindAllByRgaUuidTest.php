<?php

namespace RGA\Test\Application\ReturnPackage\Query;

use RGA\Application\ReturnPackage\Query\ReadModel\ReturnPackage;
use RGA\Application\ReturnPackage\Query\V1;
use RGA\Infrastructure\Query\ReturnPackage\InMemoryReturnPackageQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByRgaUuidTest
	extends QueryHandlerTestCase
{
	use ReturnPackageHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_return_package_by_rga_uuid()
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		
		// given
		$view1 = $this->createReturnPackageView(1, $uuid);
		$view2 = $this->createReturnPackageView(2, \Ramsey\Uuid\Uuid::uuid4()->toString());
		
		// when
		/** @var InMemoryReturnPackageQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\ReturnPackageQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAllByRgaUuid($uuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var ReturnPackage $result */
		$result = $query->getViewCollection()->current();
		
		$this->assertTrue($result->rgaUuid() === $uuid);
	}
}