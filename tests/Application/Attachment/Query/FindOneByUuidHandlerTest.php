<?php

namespace RGA\Test\Application\Attachment\Query;

use RGA\Application\Attachment\Query\ReadModel\Attachment;
use RGA\Application\Attachment\Query\V1;
use RGA\Infrastructure\Query\Attachment\InMemoryAttachmentQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindOneByUuidHandlerTest
	extends QueryHandlerTestCase
{
	use AttachmentHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_attachment_by_uuid()
	{
		$uuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		$rgaUuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		// given
		$view = $this->createAttachmentView($uuid, $rgaUuid);
		
		// when
		/** @var InMemoryAttachmentQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\AttachmentQueryInterface::class);
		$queryRepository->store($view);
		
		$query = new V1\FindOneByUuid($uuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		/** @var Attachment $result */
		$result = $query->getView();
		
		$this->assertTrue($result->identifier() === $uuid);
	}
}