<?php

namespace RGA\Test\Application\Transport\Query;

use RGA\Application\Transport\Query\ReadModel\Transport;
use RGA\Application\Transport\Query\V1;
use RGA\Infrastructure\Query\Transport\InMemoryTransportQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindOneByUuidHandlerTest
	extends QueryHandlerTestCase
{
	use TransportHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_transport_by_uuid()
	{
		$uuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		
		// given
		$view1 = $this->createTransportView($uuid, 'test');
		$view2 = $this->createTransportView(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'test2');
		
		// when
		/** @var InMemoryTransportQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\TransportQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindOneByUuid($uuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var Transport $result */
		$result = $query->getView();
		
		$this->assertTrue($result->identifier() === $uuid);
	}
}