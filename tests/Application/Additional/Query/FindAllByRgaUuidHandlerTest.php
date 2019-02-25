<?php

namespace RGA\Test\Application\Additional\Query;

use RGA\Application\Additional\Query\V1;
use RGA\Infrastructure\Query\Additional\InMemoryAdditionalQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByRgaUuidHandlerTest
	extends QueryHandlerTestCase
{
	use AdditionalHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_attachment_by_rga_uuid()
	{
		$rgaUuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		
		// given
		$view1 = $this->createAdditionalView(1, $rgaUuid);
		$view2 = $this->createAdditionalView(2, \Ramsey\Uuid\Uuid::uuid4()->toString());
		
		// when
		/** @var InMemoryAdditionalQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\AdditionalQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAllByRgaUuid($rgaUuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertTrue($query->getViewCollection()->count() === 1);
	}
}