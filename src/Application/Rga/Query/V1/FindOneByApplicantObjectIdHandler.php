<?php


namespace RGA\Application\Rga\Query\V1;


use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class FindOneByApplicantObjectIdHandler extends RgaQueryHandler
{
	/**
	 * @param MessageInterface|FindOneByApplicantObjectId $query
	 */
	public function run(MessageInterface $query)
	{
		$this->repository->findOneByApplicantObjectId($query);
	}
}