<?php

namespace RGA\Test\Application\Attachment\Query;

use RGA\Application\Attachment\Query\V1;
use RGA\Infrastructure\Query\Attachment\InMemoryAttachmentQuery;
use RGA\Test\Application\QueryHandlerTestCase;

class FindAllHandlerTest
	extends QueryHandlerTestCase
{
	use AttachmentHandlerTestTrait;
	
	/**
	 * @test
	 */
	public function it_finds_attachments()
	{
		// given
		$view1 = $this->createAttachmentView(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString());
		$view2 = $this->createAttachmentView(\Ramsey\Uuid\Uuid::uuid4()->toString(), \Ramsey\Uuid\Uuid::uuid4()->toString());
		
		// when
		/** @var InMemoryAttachmentQuery $queryRepository */
		$queryRepository = $this->getFromContainer(V1\AttachmentQueryInterface::class);
		$queryRepository->store($view1);
		$queryRepository->store($view2);
		
		$query = new V1\FindAll(1, 1);
		
		// then
		$queryBus = $this->getQueryBus();
		$queryBus->dispatch($query);
		
		$this->assertEquals($query->getViewCollection()->count(), 1);
	}
}