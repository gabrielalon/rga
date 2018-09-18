<?php

namespace RGA\Domain\Model\ReturnPackage\Command;

use RGA\Domain\Model\ReturnPackage\ReturnPackage as ValueObject;
use RGA\Infrastructure\Persist\ReturnPackage\ReturnPackageRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class SetReturnPackageHandler
	implements CommandHandlerInterface
{
	/** @var ReturnPackageRepository */
	private $repository;
	
	/**
	 * @param ReturnPackageRepository $repository
	 */
	public function __construct(ReturnPackageRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|SetReturnPackage $message
	 */
	public function run(MessageInterface $message): void
	{
		$state = $this->repository->find($message->getUuid());
		
		$state->setReturnPackage(
			ValueObject\PackageNo::fromString($message->getPackageNo()),
			ValueObject\PackageSentAt::fromString($message->getSentAt())
		);
		
		$this->repository->save($state);
	}
}