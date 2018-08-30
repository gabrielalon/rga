<?php

namespace RGA\Domain\Model\Rga\Command;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Infrastructure\Persist\Rga\RgaRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class ChangeFlagsRgaHandler
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
	 * @param MessageInterface|ChangeFlagsRga $message
	 */
	public function run(MessageInterface $message): void
	{
		$rga = $this->repository->find($message->getUuid());
		
		$rga->flagsRgaChanged(
			ValueObject\AdminNotesForApplicant::fromString($message->getNotesForApplicant()),
			ValueObject\IsProductReceived::fromBoolean($message->isProductReceived()),
			ValueObject\IsCashReturned::fromBoolean($message->isCashReturned()),
			ValueObject\IsProductReturned::fromBoolean($message->isProductReturned())
		);
		
		$this->repository->save($rga);
	}
}