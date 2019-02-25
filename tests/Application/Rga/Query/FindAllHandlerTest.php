<?php

namespace RGA\Test\Application\Rga\Query;

use RGA\Application\Rga\Query\V1;
use RGA\Infrastructure\Query\Rga\InMemoryRgaQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllHandlerTest
	extends QueryHandlerTestCase
{
	use RgaHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_rgas()
	{
		// given
		$view1 = $this->createRgaView(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$view2 = $this->createRgaView(\Ramsey\Uuid\Uuid::uuid4()->toString());
		
		// when
		/** @var InMemoryRgaQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\RgaQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAll(1, 1);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertEquals($query->getViewCollection()->count(), 1);
	}
}