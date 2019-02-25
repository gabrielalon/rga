<?php

namespace RGA\Test\Application\Attachment\Query;

use RGA\Application\Attachment\Query\V1;
use RGA\Infrastructure\Query\Attachment\InMemoryAttachmentQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllByRgaUuidHandlerTest
	extends QueryHandlerTestCase
{
	use AttachmentHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_attachment_by_rga_uuid()
	{
		$rgaUuid = (string)\Ramsey\Uuid\Uuid::uuid4()->toString();
		
		// given
		$view1 = $this->createAttachmentView((string)\Ramsey\Uuid\Uuid::uuid4()->toString(), $rgaUuid);
		$view2 = $this->createAttachmentView((string)\Ramsey\Uuid\Uuid::uuid4()->toString(), (string)\Ramsey\Uuid\Uuid::uuid4()->toString());
		
		// when
		/** @var InMemoryAttachmentQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\AttachmentQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAllByRgaUuid($rgaUuid);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertTrue($query->getViewCollection()->count() === 1);
	}
}