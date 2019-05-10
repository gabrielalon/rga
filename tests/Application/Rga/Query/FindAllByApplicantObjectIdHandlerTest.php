<?php

namespace RGA\Test\Application\Rga\Query;

use RGA\Application\Rga\Query\ReadModel\Rga;
use RGA\Application\Rga\Query\V1;
use RGA\Infrastructure\Query\Rga\InMemoryRgaQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByApplicantObjectIdHandlerTest
	extends QueryHandlerTestCase
{
	use RgaHandlerTestTrait;

	/**
	 * @test
	 */
	public function it_finds_rga_by_applicant_object_id()
	{
		$uuid1 = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		$no1 = (int)$uuid1;

		$uuid2 = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		$no2 = (int)$uuid2;
		// given
		$view1 = $this->createRgaView($uuid1);
		$view2 = $this->createRgaView($uuid2);

		// when
		/** @var InMemoryRgaQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\RgaQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);

		$query = new V1\FindAllByApplicantObjectId($no1);

		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);

		$collection = $query->getViewCollection();
		/** @var Rga $result */
		$result = $collection->current();

		$this->assertTrue($result->applicantObjectId() == $no1);
		$this->assertTrue($result->applicantObjectId() != $no2);
	}
}