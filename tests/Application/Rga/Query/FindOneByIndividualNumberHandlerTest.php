<?php

namespace RGA\Test\Application\Rga\Query;

use RGA\Application\Rga\Query\ReadModel\Rga;
use RGA\Application\Rga\Query\V1;
use RGA\Infrastructure\Query\Rga\InMemoryRgaQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindOneByIndividualNumberHandlerTest
	extends QueryHandlerTestCase
{
	use RgaHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_rga_by_hash()
	{
		$uuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		$no = (int)$uuid;
		// given
		$view = $this->createRgaView($uuid);
		
		// when
		/** @var InMemoryRgaQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\RgaQueryInterface::class);
		$queryRepository->store($view);
		
		$query = new V1\FindOneByIndividualNumber($no);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var Rga $result */
		$result = $query->getView();
		
		$this->assertTrue($result->individualNumber() == $no);
	}
}