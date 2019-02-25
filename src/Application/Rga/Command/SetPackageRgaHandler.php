<?php

namespace RGA\Application\Rga\Command;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Infrastructure\Persist\Rga\RgaRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class SetPackageRgaHandler
	implements CommandHandlerInterface
{
	/** @var RgaRepository */
	private $repository;
	
	/**
	 * @param RgaRepository $repository
	 */
	public function __construct(RgaRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|SetPackageRga $message
	 */
	public function run(MessageInterface $message): void
	{
		$state = $this->repository->find($message->getIdentifier());
		
		$state->setPackageRga(
			ValueObject\PackageNo::fromString($message->getPackageNo()),
			ValueObject\PackageSentAt::fromString($message->getSentAt())
		);
		
		$this->repository->save($state);
	}
}